<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Services\SepayService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CartOrderController extends Controller
{
    /**
     * 1. Tạo đơn hàng tổng từ giỏ hàng (Mã tăng dần HIKI + 8 số từ ID)
     */
    public function store(Request $request)
    {
        $cartIds = $request->input('cart_ids');

        if (empty($cartIds) || !is_array($cartIds)) {
            return back()->with('error', 'Vui lòng chọn ít nhất một cuốn sách để thanh toán.');
        }

        $cartItems = Cart::with('book')
                         ->where('user_id', auth()->id())
                         ->whereIn('id', $cartIds)
                         ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Không tìm thấy sản phẩm hợp lệ trong giỏ hàng.');
        }

        $sharedGroupCode = 'GRP' . strtoupper(Str::random(8)); 
        $representativeOrder = null;

        DB::transaction(function () use ($cartItems, $sharedGroupCode, $cartIds, &$representativeOrder) {
            foreach ($cartItems as $index => $item) {
                if (empty($item->book_id)) { continue; }

                // Bước A: Tạo bản ghi trước để lấy ID tự tăng từ MySQL
                $order = Order::create([
                    'user_id'         => auth()->id(),
                    'book_id'         => $item->book_id,
                    'vip_plan_id'     => null,
                    'coupon_id'       => null,
                    'amount'          => $item->price, 
                    'discount'        => 0,
                    'final_amount'    => $item->price, 
                    'payment_method'  => 'sepay',
                    'status'          => 'pending',
                    'order_code'      => 'TMP_' . time() . '_' . $index, // Gán tạm thời
                    'cart_group_code' => $sharedGroupCode,   
                ]);

                // Bước B: Sửa lại cấu trúc mã -> HIKI + 8 chữ số tăng dần chuẩn đét
                $formattedOrderCode = 'HIKI' . str_pad($order->id, 8, '0', STR_PAD_LEFT);
                
                $order->update([
                    'order_code' => $formattedOrderCode
                ]);

                if ($index === 0) {
                    $representativeOrder = $order;
                }
            }

            // Cart::where('user_id', auth()->id())->whereIn('id', $cartIds)->delete();
        });

        if (!$representativeOrder) {
            return redirect()->route('cart.index')->with('error', 'Không thể khởi tạo đơn hàng.');
        }

        return redirect()->route('book.order', $representativeOrder);
    }

    /**
     * 2. Trang xác nhận đơn hàng 
     */
    public function order(Order $order)
    {
        abort_unless(auth()->check() && $order->user_id == auth()->id(), 403);

        if ($order->cart_group_code) {
            $subOrders = Order::with('book')->where('cart_group_code', $order->cart_group_code)->get();
        } else {
            $subOrders = collect([$order]);
        }

        return view('order.order', compact('order', 'subOrders'));
    }

    /**
     * 3. Trang hiển thị giao diện Quét mã QR SePay tổng (ÉP CHUYỂN SỐ TIỀN TỔNG)
     */
    public function checkout(Order $order, SepayService $sepay)
    {
        abort_unless(auth()->check() && $order->user_id == auth()->id(), 403);

        if ($order->status === 'paid') {
            return redirect()->route('cart.index')->with('success', 'Đơn hàng đã được mở khoá thành công!');
        }

        // 🌟 Giải pháp: Thay vì dùng $order->final_amount gốc của 1 cuốn, ta tính tổng tiền giỏ hàng
        $totalAmount = $order->final_amount;
        if ($order->cart_group_code) {
            $totalAmount = Order::where('cart_group_code', $order->cart_group_code)->sum('final_amount');
        }

        // Gọi hàm sinh QR với tham số số tiền tổng đã ép buộc
        $payment = $sepay->qrCustom($order, $totalAmount);

        return view('order.payment', compact('order', 'payment'));
    }

    /**
     * 4. Áp dụng mã giảm giá
     */
    public function applyCoupon(Request $request, Order $order)
    {
        abort_unless(auth()->check() && $order->user_id == auth()->id(), 403);

        if ($order->status !== 'pending') { return back()->with('error', 'Đơn hàng không thể áp dụng mã giảm giá.'); }

        $request->validate(['code' => 'required|string|max:50']);

        $coupon = Coupon::where('code', strtoupper(trim($request->code)))->where('active', true)->first();

        if (!$coupon) { return back()->with('error', 'Mã giảm giá không tồn tại.'); }
        if ($coupon->started_at && now()->lt($coupon->started_at)) { return back()->with('error', 'Mã giảm giá chưa có hiệu lực.'); }
        if ($coupon->expired_at && now()->gt($coupon->expired_at)) { return back()->with('error', 'Mã giảm giá đã hết hạn.'); }
        if ($coupon->usage_limit && $coupon->used_count >= $coupon->usage_limit) { return back()->with('error', 'Mã giảm giá đã hết lượt sử dụng.'); }

        $queryCode = $order->cart_group_code ?: $order->order_code;
        $column = $order->cart_group_code ? 'cart_group_code' : 'order_code';
        
        $ordersInGroup = Order::where($column, $queryCode)->get();
        $totalGroupAmount = $ordersInGroup->sum('amount');

        if ($totalGroupAmount < $coupon->min_order_amount) {
            return back()->with('error', 'Đơn hàng tối thiểu ' . number_format($coupon->min_order_amount) . 'đ mới được dùng mã này.');
        }

        if ($coupon->type == 'percent') {
            $totalDiscount = $totalGroupAmount * $coupon->value / 100;
            if ($coupon->max_discount) { $totalDiscount = min($totalDiscount, $coupon->max_discount); }
        } else {
            $totalDiscount = $coupon->value;
        }

        $totalDiscount = min($totalDiscount, $totalGroupAmount);
        $count = $ordersInGroup->count();

        DB::transaction(function () use ($ordersInGroup, $coupon, $totalDiscount, $totalGroupAmount, $count) {
            $remainingDiscount = $totalDiscount;

            foreach ($ordersInGroup as $index => $subOrder) {
                if ($index === $count - 1) {
                    $itemDiscount = $remainingDiscount;
                } else {
                    $itemDiscount = round(($subOrder->amount / $totalGroupAmount) * $totalDiscount);
                    $remainingDiscount -= $itemDiscount;
                }

                $subOrder->update([
                    'coupon_id'    => $coupon->id,
                    'discount'     => $itemDiscount,
                    'final_amount' => max(0, $subOrder->amount - $itemDiscount),
                ]);
            }
        });

        return back()->with('success', 'Áp dụng mã giảm giá thành công cho giỏ hàng.');
    }

    /**
     * 5. Xóa mã giảm giá
     */
    public function removeCoupon(Order $order)
    {
        abort_unless(auth()->check() && $order->user_id == auth()->id(), 403);

        if ($order->status !== 'pending') { return back()->with('error', 'Đơn hàng không thể chỉnh sửa.'); }

        $queryCode = $order->cart_group_code ?: $order->order_code;
        $column = $order->cart_group_code ? 'cart_group_code' : 'order_code';

        Order::where($column, $queryCode)->update([
            'coupon_id'    => null,
            'discount'     => 0,
            'final_amount' => DB::raw('amount'), 
        ]);

        return back()->with('success', 'Đã xoá mã giảm giá khỏi giỏ hàng.');
    }
}
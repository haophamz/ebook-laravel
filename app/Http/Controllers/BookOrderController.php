<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\SepayService;
use App\Models\Coupon;

class BookOrderController extends Controller
{
    /**
     * Tạo đơn hàng mua ebook
     * Gọi từ nút "Mua ngay" ở trang chi tiết sách
     */
    public function store(Book $book)
    {
        if ($book->access_type != 'paid') {
            abort(404);
        }

        $order = Order::create([
            'user_id'        => auth()->id(),
            'book_id'        => $book->id,
            'vip_plan_id'    => null,
            'coupon_id'      => null,
            'amount'         => $book->price,
            'discount'       => 0,
            'final_amount'   => $book->price,
            'payment_method' => 'sepay',
            'status'         => 'pending',
        ]);

        $order->update([
            'order_code' => 'HIKI' . str_pad(
                $order->id,
                8,
                '0',
                STR_PAD_LEFT
            ),
        ]);

        return redirect()->route('book.order', $order);
    }

    /**
     * Trang xác nhận đơn hàng
     */
    public function order(Order $order)
    {
        abort_unless(
            auth()->check() &&
            $order->user_id == auth()->id(),
            403
        );

        return view(
            'order.order',
            compact('order')
        );
    }

    /**
     * Trang thanh toán QR SePay
     */
    public function checkout(
        Order $order,
        SepayService $sepay
    ) {
        abort_unless(
            auth()->check() &&
            $order->user_id == auth()->id(),
            403
        );

        if ($order->status === 'paid') {

            return redirect()->route('home.render', $order->book->slug)
                ->with(
                    'success',
                    'Ebook đã được mở khoá.'
                );

        }

        $payment = $sepay->qr($order);

        return view(
            'order.payment',
            compact(
                'order',
                'payment'
            )
        );
    }

    /**
     * AJAX kiểm tra trạng thái thanh toán
     */
    public function checkPayment(Order $order)
    {
        abort_unless(
            auth()->check() &&
            $order->user_id == auth()->id(),
            403
        );

        return response()->json([
            'status'     => $order->status,
            'paid_at'    => $order->paid_at,
            'order_code' => $order->order_code,
            'amount'     => $order->final_amount,
        ]);
    }

    /**
     * Áp dụng mã giảm giá
     */
    public function applyCoupon(Request $request, Order $order)
    {
        abort_unless(
            auth()->check() &&
            $order->user_id == auth()->id(),
            403
        );

        if ($order->status !== 'pending') {
            return back()->with('error', 'Đơn hàng không thể áp dụng mã giảm giá.');
        }

        $request->validate([
            'code' => 'required|string|max:50',
        ]);

        $coupon = Coupon::where('code', strtoupper(trim($request->code)))
            ->where('active', true)
            ->first();

        if (!$coupon) {
            return back()->with('error', 'Mã giảm giá không tồn tại.');
        }

        if ($coupon->started_at && now()->lt($coupon->started_at)) {
            return back()->with('error', 'Mã giảm giá chưa có hiệu lực.');
        }

        if ($coupon->expired_at && now()->gt($coupon->expired_at)) {
            return back()->with('error', 'Mã giảm giá đã hết hạn.');
        }

        if (
            $coupon->usage_limit &&
            $coupon->used_count >= $coupon->usage_limit
        ) {
            return back()->with('error', 'Mã giảm giá đã hết lượt sử dụng.');
        }

        if ($order->amount < $coupon->min_order_amount) {
            return back()->with(
                'error',
                'Đơn hàng tối thiểu ' .
                number_format($coupon->min_order_amount) .
                'đ mới được dùng mã này.'
            );
        }

        if ($coupon->type == 'percent') {

            $discount = $order->amount * $coupon->value / 100;

            if ($coupon->max_discount) {
                $discount = min(
                    $discount,
                    $coupon->max_discount
                );
            }

        } else {

            $discount = $coupon->value;

        }

        $discount = min($discount, $order->amount);

        $order->update([

            'coupon_id'    => $coupon->id,

            'discount'     => $discount,

            'final_amount' => $order->amount - $discount,

        ]);

        return back()->with(
            'success',
            'Áp dụng mã giảm giá thành công.'
        );
    }

    /**
     * Xoá mã giảm giá
     */
    public function removeCoupon(Order $order)
    {
        abort_unless(
            auth()->check() &&
            $order->user_id == auth()->id(),
            403
        );

        if ($order->status !== 'pending') {
            return back()->with('error', 'Đơn hàng không thể chỉnh sửa.');
        }

        $order->update([
            'coupon_id'    => null,
            'discount'     => 0,
            'final_amount' => $order->amount,
        ]);

        return back()->with('success', 'Đã xoá mã giảm giá.');
    }
    public function checkoutCart()
{
    // 1. Lấy toàn bộ sách trong giỏ hàng của user
    $cartItems = \App\Models\Cart::where('user_id', auth()->id())->get();

    if ($cartItems->isEmpty()) {
        return back()->with('error', 'Giỏ hàng của bạn đang trống.');
    }

    // 2. Tính tổng số tiền
    $totalAmount = $cartItems->sum('price');

    // 3. Tạo một đơn hàng tổng (Mô hình Order của bạn cần bổ sung logic lưu nhiều sách hoặc xử lý tùy cấu trúc DB)
    // Nếu bảng orders của bạn chỉ chứa 1 book_id, bạn có thể tạo Đơn hàng cha hoặc tạo vòng lặp đơn lẻ.
    // Dưới đây là ví dụ tạo Đơn hàng tổng (nếu bảng orders cho phép book_id nullable hoặc lưu chuỗi):
    $order = Order::create([
        'user_id'        => auth()->id(),
        'book_id'        => null, // Hoặc xử lý theo mối quan hệ n-n tùy DB của bạn
        'vip_plan_id'    => null,
        'coupon_id'      => null,
        'amount'         => $totalAmount,
        'discount'       => 0,
        'final_amount'   => $totalAmount,
        'payment_method' => 'sepay',
        'status'         => 'pending',
    ]);

    $order->update([
        'order_code' => 'HIKI' . str_pad($order->id, 8, '0', STR_PAD_LEFT),
    ]);

    // 4. Xóa giỏ hàng sau khi đã chuyển thành đơn hàng thành công
    \App\Models\Cart::where('user_id', auth()->id())->delete();

    // 5. Chuyển hướng đến trang xác nhận đơn hàng/quét mã SePay đã có sẵn của bạn
    return redirect()->route('book.order', $order);
}
}
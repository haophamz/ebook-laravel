<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\VipPlan;
use Illuminate\Http\Request;
use App\Services\SepayService;
use App\Models\Coupon;
class VipController extends Controller
{
    /**
     * Tạo đơn hàng VIP
     */
    public function subscribe(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:vip_plans,id',
        ]);

        $plan = VipPlan::findOrFail($request->plan_id);

        $order = Order::create([
            'user_id'        => auth()->id(),
            'vip_plan_id'    => $plan->id,
            'coupon_id'      => null,
            'amount'         => $plan->price,
            'discount'       => 0,
            'final_amount'   => $plan->price,
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

        return redirect()->route('vip.order', $order);
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
            'vip.order',
            compact('order')
        );
    }

    /**
     * Trang thanh toán
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

            return redirect('/')
                ->with(
                    'success',
                    'Gói VIP đã được kích hoạt.'
                );

        }

        $payment = $sepay->qr($order);

        return view(
            'vip.checkout',
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
            'status'      => $order->status,
            'paid_at'     => $order->paid_at,
            'order_code'  => $order->order_code,
            'amount'      => $order->final_amount,
        ]);
    }
    //them coup
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
}
<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\VipPlan;
use Illuminate\Http\Request;
use App\Services\SepayService;
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
}
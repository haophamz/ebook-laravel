<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use App\Services\SepayService;
use App\Services\VipService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebhookController extends Controller
{
    public function sepay(
        Request $request,
        SepayService $sepay,
        VipService $vip
    ) {
        // Kiểm tra chữ ký HMAC
        if (!$sepay->verify($request)) {

            return response()->json([
                'success' => false,
                'message' => 'Invalid signature'
            ], 401);

        }

        $data = $request->all();

        // Chỉ nhận giao dịch tiền vào
        if (($data['transferType'] ?? '') !== 'in') {

            return response()->json([
                'success' => true
            ]);

        }

        DB::transaction(function () use ($data, $sepay, $vip) {

            $order = $sepay->findOrder($data);

            if (!$order) {
                return;
            }

            // Đã thanh toán rồi thì bỏ qua
            if ($order->status === 'paid') {
                return;
            }

            // Sai số tiền
            if (!$sepay->validAmount($order, $data)) {
                return;
            }

            // Tránh lưu trùng transaction
            if (
                Transaction::where(
                    'transaction_code',
                    $data['referenceCode'] ?? null
                )->exists()
            ) {
                return;
            }

            Transaction::create([

                'order_id' => $order->id,

                'gateway' => 'sepay',

                'transaction_code' => $data['referenceCode'] ?? null,

                'gateway_order_id' => $data['id'] ?? null,

                'amount' => $data['transferAmount'] ?? 0,

                'status' => 'success',

                'response' => $data,

                'paid_at' => now(),

            ]);

            $order->update([

                'status' => 'paid',

                'payment_method' => 'bank',

                'paid_at' => now(),

            ]);
            if ($order->coupon) {

    $order->coupon->increment('used_count');

}

            $vip->activate(
                $order->user,
                $order->vipPlan->months
            );

        });

        return response()->json([
            'success' => true
        ]);
    }
}
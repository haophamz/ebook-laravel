<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Http\Request;

class SepayService
{
    /**
     * Kiểm tra chữ ký webhook
     */
public function verify(Request $request): bool
{
    $secret = config('services.sepay.secret');

    if (!$secret) {
        return false;
    }

    $signature = $request->header('X-SePay-Signature')
        ?? $request->header('x-sepay-signature');

    $timestamp = (int) (
        $request->header('X-SePay-Timestamp')
        ?? $request->header('x-sepay-timestamp')
    );

    if (!$signature || !$timestamp) {
        return false;
    }

    // Chống replay attack (5 phút)
    if (abs(time() - $timestamp) > 300) {
        return false;
    }

    $body = $request->getContent();

    $expected = 'sha256=' . hash_hmac(
        'sha256',
        $timestamp . '.' . $body,
        $secret
    );

    return hash_equals($expected, $signature);
}

    /**
     * Sinh thông tin QR VietQR
     */
    public function qr(Order $order): array
{
    $bank = config('services.sepay.bank');

    $account = config('services.sepay.account');

    $name = config('services.sepay.name');

    $amount = (int) $order->final_amount;

    $content = 'Thanh toan don hang ' . $order->order_code;

    $qr = 'https://vietqr.app/img?' . http_build_query([
        'bank'     => $bank,
        'acc'      => $account,
        'amount'   => $amount,
        'des'      => $content,
        'template' => 'compact',
    ]);

    return [

        'qr_url' => $qr,

        'bank_name' => $bank,

        'account_number' => $account,

        'account_name' => $name,

        'amount' => $amount,

        'content' => $content,

    ];
}

    /**
     * Tìm Order từ nội dung chuyển khoản
     */
    public function findOrder(array $data): ?Order
    {
        $text = strtoupper(
            ($data['content'] ?? '') . ' ' .
            ($data['description'] ?? '') . ' ' .
            ($data['code'] ?? '')
        );

        if (!preg_match('/HIKI\d{8}/i', $text, $match)) {
            return null;
        }

        return Order::where(
            'order_code',
            strtoupper($match[0])
        )->first();
    }

    /**
     * Kiểm tra số tiền
     */
    public function validAmount(
        Order $order,
        array $data
    ): bool {

        return (int) $order->final_amount ===
               (int) ($data['transferAmount'] ?? 0);

    }
}
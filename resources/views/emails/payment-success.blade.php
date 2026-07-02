<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family:Arial,sans-serif;background:#f3f4f6;padding:20px;">
<div style="max-width:620px;margin:auto;background:#fff;padding:24px;border-radius:14px;">
    <h2 style="color:#18c29c;">Thanh toán thành công</h2>

    <p>Xin chào {{ $order->user?->name ?? 'bạn' }},</p>

    <p>Đơn hàng của bạn đã được thanh toán thành công.</p>

    <p>
        <strong>Mã đơn:</strong> #{{ $order->id }} <br>
        <strong>Tổng tiền:</strong> {{ number_format($orders->sum('final_amount')) }}đ
    </p>

    <h3>Chi tiết đơn hàng</h3>

    <ul>
        @foreach($orders as $item)
            <li>
                @if($item->vip_plan_id)
                    Gói VIP: {{ $item->vipPlan?->name ?? 'VIP' }}
                @elseif($item->book_id)
                    Sách ID: {{ $item->book_id }}
                @else
                    Đơn hàng #{{ $item->id }}
                @endif

                - {{ number_format($item->final_amount) }}đ
            </li>
        @endforeach
    </ul>

    <p style="margin-top:24px;">
        <a href="{{ route('account.purchased') }}"
           style="background:#18c29c;color:#fff;padding:12px 18px;border-radius:8px;text-decoration:none;">
            Xem sách đã mua
        </a>
    </p>
</div>
</body>
</html>
@extends('layouts.app')

@section('content')

<style>
.order-page{
    min-height:100vh;
    background:linear-gradient(135deg, #e8f0fe 0%, #dbeafe 50%, #ede9fe 100%);
    display:flex;
    justify-content:center;
    align-items:flex-start;
    padding:64px 20px;
    font-family:'Segoe UI',system-ui,-apple-system,sans-serif;
}

.order-page *{
    box-sizing:border-box;
}

.order-card{
    width:100%;
    max-width:560px;
    background:#fff;
    border-radius:24px;
    overflow:hidden;
    border:2px solid transparent;
    box-shadow:
        0 4px 24px rgba(0,0,0,.06),
        0 24px 60px rgba(24,194,156,.14);
}

/*======================
HEADER
=======================*/

.order-head{
    padding:32px 36px;
    background:linear-gradient(160deg, #0e9e7e 0%, #13b090 40%, #18c29c 100%);
    position:relative;
}

.order-head .eyebrow{
    font-size:11px;
    text-transform:uppercase;
    letter-spacing:2.5px;
    font-weight:700;
    color:#fbbf24;
    margin-bottom:8px;
}

.order-head h2{
    margin:0;
    color:#fff;
    font-size:24px;
    font-weight:800;
    letter-spacing:-.3px;
}

.head-row{
    display:flex;
    justify-content:space-between;
    align-items:flex-end;
    gap:16px;
}

.order-code-tag{
    flex-shrink:0;
    padding:8px 14px;
    border-radius:10px;
    background:rgba(255,255,255,.18);
    border:1px solid rgba(255,255,255,.25);
    color:#fff;
    font-weight:700;
    font-size:13px;
    font-family:'SF Mono',Consolas,monospace;
    letter-spacing:.5px;
}

.status-badge{
    display:inline-flex;
    align-items:center;
    gap:6px;
    margin-top:14px;
    padding:5px 12px;
    border-radius:999px;
    font-size:12px;
    font-weight:600;
}

.status-badge.pending{
    background:rgba(251,191,36,.20);
    color:#fbbf24;
}

.status-badge.paid{
    background:rgba(74,222,128,.20);
    color:#4ade80;
}

.status-badge .dot{
    width:6px;
    height:6px;
    border-radius:50%;
    background:currentColor;
}

/*======================
CUSTOMER INFO
=======================*/

.customer-strip{
    padding:18px 36px;
    background:rgba(24,194,156,.05);
    border-bottom:1px solid rgba(24,194,156,.15);
    display:flex;
    justify-content:space-between;
    gap:24px;
    flex-wrap:wrap;
}

.customer-strip .field{
    min-width:0;
}

.customer-strip .field-label{
    font-size:11px;
    text-transform:uppercase;
    letter-spacing:1px;
    color:#93a4c3;
    font-weight:700;
    margin-bottom:3px;
}

.customer-strip .field-value{
    font-size:14px;
    color:#111827;
    font-weight:600;
    overflow:hidden;
    text-overflow:ellipsis;
}

/*======================
BODY
=======================*/

.order-body{
    padding:30px 36px 0;
}

.info-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:14px 0;
    border-bottom:1px solid #eef2fb;
}

.info-row:last-child{
    border:none;
}

.info-title{
    color:#6b7280;
    font-size:14px;
}

.info-value{
    color:#111827;
    font-size:15px;
    font-weight:600;
}

.coupon-row .info-value{
    color:#18c29c;
    display:flex;
    align-items:center;
    gap:8px;
}

.coupon-row .remove-coupon{
    font-size:12px;
    font-weight:600;
    color:#93a4c3;
    text-decoration:underline;
    cursor:pointer;
    background:none;
    border:none;
    padding:0;
}

.coupon-row .remove-coupon:hover{
    color:#dc2626;
}

/*======================
PRICE SUMMARY
=======================*/

.price-block{
    margin:26px 36px 0;
    padding:24px;
    background:rgba(24,194,156,.06);
    border:1px solid rgba(24,194,156,.25);
    border-radius:16px;
}

.price-original{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:6px;
}

.price-original .label{
    font-size:13px;
    color:#6b8cc4;
}

.price-original .value{
    font-size:15px;
    color:#5a7bb5;
    text-decoration:line-through;
    font-weight:600;
}

.price-final-row{
    display:flex;
    justify-content:space-between;
    align-items:baseline;
    margin-top:10px;
}

.price-final-row .label{
    font-size:13px;
    text-transform:uppercase;
    letter-spacing:1px;
    font-weight:700;
    color:#18c29c;
}

.price-final-row .value{
    font-size:32px;
    font-weight:900;
    color:#18c29c;
    letter-spacing:-.5px;
}

.savings-tag{
    display:inline-flex;
    align-items:center;
    gap:6px;
    margin-top:14px;
    padding:6px 12px;
    background:#fef3c7;
    color:#92400e;
    font-size:12px;
    font-weight:700;
    border-radius:8px;
}

/*======================
COUPON BOX
=======================*/

.coupon-box{
    margin:20px 36px 0;
    padding:18px 20px;
    background:rgba(24,194,156,.05);
    border:1px dashed rgba(24,194,156,.35);
    border-radius:14px;
}

.coupon-box .pay-title{
    font-size:12px;
    text-transform:uppercase;
    letter-spacing:1px;
    color:#6b7280;
    font-weight:700;
    margin-bottom:10px;
}

.coupon-box form{
    display:flex;
    gap:10px;
}

.coupon-box input{
    flex:1;
    padding:11px 14px;
    border:1px solid rgba(24,194,156,.25);
    border-radius:10px;
    font-size:14px;
    font-family:'SF Mono',Consolas,monospace;
    text-transform:uppercase;
    letter-spacing:.5px;
    color:#111827;
    background:#fff;
}

.coupon-box input:focus{
    outline:none;
    border-color:#18c29c;
}

.coupon-box .btn-apply{
    padding:11px 20px;
    border:none;
    border-radius:10px;
    background:#18c29c;
    color:#fff;
    font-weight:700;
    font-size:14px;
    cursor:pointer;
    transition:.2s;
    white-space:nowrap;
}

.coupon-box .btn-apply:hover{
    background:#0e9e7e;
}

.coupon-error{
    margin-top:10px;
    font-size:13px;
    color:#dc2626;
}

.coupon-success{
    margin-top:10px;
    font-size:13px;
    color:#16a34a;
}

/*======================
PAYMENT METHOD
=======================*/

.pay-box{
    margin:20px 36px 0;
    padding:18px 20px;
    background:rgba(24,194,156,.05);
    border:1px solid rgba(24,194,156,.15);
    border-radius:14px;
    display:flex;
    align-items:center;
    gap:12px;
}

.pay-box .pay-icon{
    width:36px;
    height:36px;
    border-radius:9px;
    background:#18c29c;
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:15px;
    font-weight:800;
    flex-shrink:0;
}

.pay-box .pay-text .pay-title{
    font-size:11px;
    text-transform:uppercase;
    letter-spacing:1px;
    color:#93a4c3;
    font-weight:700;
    margin-bottom:2px;
}

.pay-box .pay-method{
    color:#111827;
    font-size:14px;
    font-weight:600;
}

/*======================
BUTTONS
=======================*/

.actions{
    display:grid;
    grid-template-columns:1fr 1.7fr;
    gap:12px;
    margin:26px 36px 32px;
}

.btn-back{
    text-align:center;
    padding:16px;
    color:#3b4d6b;
    background:#fff;
    border:1px solid rgba(24,194,156,.25);
    border-radius:12px;
    text-decoration:none;
    font-weight:700;
    font-size:14px;
    transition:.2s;
}

.btn-back:hover{
    background:rgba(24,194,156,.06);
    border-color:#18c29c;
}

.btn-pay{
    text-align:center;
    padding:16px;
    background:#18c29c;
    border-radius:12px;
    color:#fff;
    text-decoration:none;
    font-weight:700;
    font-size:14px;
    transition:.2s;
    box-shadow:0 8px 20px rgba(24,194,156,.35);
}

.btn-pay:hover{
    background:#0e9e7e;
    color:#fff;
}

/*======================
MOBILE
=======================*/

@media(max-width:640px){

    .order-page{
        padding:0;
        align-items:stretch;
    }

    .order-card{
        border-radius:0;
        border:none;
        box-shadow:none;
        min-height:100vh;
    }

    .order-head,
    .customer-strip,
    .order-body{
        padding-left:22px;
        padding-right:22px;
    }

    .price-block,
    .coupon-box,
    .pay-box,
    .actions{
        margin-left:22px;
        margin-right:22px;
    }

    .price-final-row .value{
        font-size:26px;
    }

    .actions{
        grid-template-columns:1fr;
    }

    .coupon-box form{
        flex-direction:column;
    }
}

</style>

<div class="order-page">

<div class="order-card">

<div class="order-head">

    <div class="eyebrow">Đơn hàng nâng cấp VIP</div>

    <div class="head-row">
        <h2>Xác nhận trước khi thanh toán</h2>
        <div class="order-code-tag">#{{ $order->order_code }}</div>
    </div>

    <div class="status-badge {{ $order->status === 'paid' ? 'paid' : 'pending' }}">
        <span class="dot"></span>
        {{ $order->status === 'paid' ? 'Đã thanh toán' : 'Chờ thanh toán' }}
    </div>

</div>

<div class="customer-strip">

    <div class="field">
        <div class="field-label">Khách hàng</div>
        <div class="field-value">{{ $order->user->name }}</div>
    </div>

    <div class="field">
        <div class="field-label">Ngày tạo đơn</div>
        <div class="field-value">{{ $order->created_at->format('d/m/Y H:i') }}</div>
    </div>

</div>

<div class="order-body">

    <div class="info-row">
        <span class="info-title">Gói thành viên</span>
        <span class="info-value">{{ $order->plan->name }}</span>
    </div>

    <div class="info-row">
        <span class="info-title">Thời hạn</span>
        <span class="info-value">{{ $order->plan->months }} tháng</span>
    </div>

    @if($order->coupon)
    <div class="info-row coupon-row">
        <span class="info-title">Mã giảm giá</span>
        <span class="info-value">
            {{ $order->coupon->code }}
            <form action="{{ route('order.coupon.remove', $order) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="remove-coupon">Xoá mã</button>
            </form>
        </span>
    </div>
    @endif

</div>

<div class="price-block">

    @if($order->discount > 0)
    <div class="price-original">
        <span class="label">Giá gốc</span>
        <span class="value">{{ number_format($order->amount) }}đ</span>
    </div>
    @endif

    <div class="price-final-row">
        <span class="label">Tổng thanh toán</span>
        <span class="value">{{ number_format($order->final_amount) }}đ</span>
    </div>

    @if($order->discount > 0)
    <div class="savings-tag">
    Bạn tiết kiệm {{ number_format($order->discount) }}đ
    </div>
    @endif

</div>

<div class="coupon-box">

    <div class="pay-title">{{ $order->coupon ? 'Đổi mã giảm giá khác' : 'Bạn có mã giảm giá?' }}</div>

    <form action="{{ route('order.coupon', $order) }}" method="POST">
        @csrf
        <input
            type="text"
            name="code"
            placeholder="Nhập mã giảm giá">
        <button type="submit" class="btn-apply">Áp dụng</button>
    </form>

    @if(session('error'))
        <div class="coupon-error">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="coupon-success">{{ session('success') }}</div>
    @endif

</div>

<div class="pay-box">
    <div class="pay-icon">QR</div>
    <div class="pay-text">
        <div class="pay-title">Phương thức thanh toán</div>
        <div class="pay-method">Chuyển khoản ngân hàng qua SePay QR</div>
    </div>
</div>

<div class="actions">
    <a href="{{ route('pricing') }}" class="btn-back">← Chọn lại gói</a>
    <a href="{{ route('vip.checkout', $order) }}" class="btn-pay">Tiếp tục thanh toán →</a>
</div>

</div>

</div>

@endsection
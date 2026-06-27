@extends('layouts.app')

@section('content')

<style>

.order-page{
    min-height:100vh;
    background:#f5f7fb;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:50px 20px;
}

.order-card{
    width:100%;
    max-width:700px;
    background:#fff;
    border-radius:24px;
    box-shadow:0 20px 60px rgba(0,0,0,.08);
    overflow:hidden;
}

.order-head{
    background:linear-gradient(135deg,#2563eb,#3b82f6);
    color:#fff;
    text-align:center;
    padding:35px;
}

.order-head h2{
    margin:0;
    font-size:32px;
    font-weight:700;
}

.order-head p{
    margin-top:8px;
    opacity:.9;
}

.order-body{
    padding:35px;
}

.info-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:16px 0;
    border-bottom:1px solid #eee;
}

.info-row:last-child{
    border:none;
}

.info-title{
    color:#666;
    font-size:15px;
}

.info-value{
    font-weight:700;
    color:#111827;
}

.total{
    margin-top:25px;
    padding:22px;
    border-radius:16px;
    background:#eff6ff;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.total span:first-child{
    font-size:18px;
    font-weight:600;
}

.total span:last-child{
    font-size:32px;
    color:#2563eb;
    font-weight:800;
}

.pay-box{
    margin-top:30px;
    background:#f9fafb;
    border-radius:16px;
    padding:20px;
}

.pay-title{
    font-weight:700;
    margin-bottom:12px;
}

.actions{
    display:flex;
    gap:15px;
    margin-top:35px;
}

.btn-back{
    flex:1;
    text-align:center;
    padding:15px;
    border-radius:14px;
    text-decoration:none;
    border:1px solid #ddd;
    color:#444;
    font-weight:600;
}

.btn-pay{
    flex:2;
    text-align:center;
    padding:15px;
    border-radius:14px;
    text-decoration:none;
    background:#2563eb;
    color:#fff;
    font-weight:700;
}

.btn-pay:hover{
    background:#1d4ed8;
    color:#fff;
}

</style>

<div class="order-page">

<div class="order-card">

<div class="order-head">

<h2>Xác nhận đơn hàng</h2>

<p>Kiểm tra lại thông tin trước khi thanh toán</p>

</div>

<div class="order-body">

<div class="info-row">
    <span class="info-title">Mã đơn hàng</span>
    <span class="info-value">{{ $order->order_code }}</span>
</div>

<div class="info-row">
    <span class="info-title">Gói thành viên</span>
    <span class="info-value">
        {{ $order->plan->name }}
    </span>
</div>

<div class="info-row">
    <span class="info-title">Thời hạn</span>
    <span class="info-value">
        {{ $order->plan->months }} tháng
    </span>
</div>

<div class="info-row">
    <span class="info-title">Giá gốc</span>
    <span class="info-value">
        {{ number_format($order->amount) }}đ
    </span>
</div>

<div class="info-row">
    <span class="info-title">Giảm giá</span>
    <span class="info-value">
        {{ number_format($order->discount) }}đ
    </span>
</div>

<div class="total">

<span>Tổng thanh toán</span>

<span>
{{ number_format($order->final_amount) }}đ
</span>

</div>

<div class="pay-box">

<div class="pay-title">
Phương thức thanh toán
</div>

<div>
🏦 Chuyển khoản ngân hàng qua SePay QR
</div>

</div>

<div class="actions">

<a href="{{ route('pricing') }}"
class="btn-back">
← Chọn lại gói
</a>

<a href="{{ route('vip.checkout',$order) }}"
class="btn-pay">
Tiếp tục thanh toán →
</a>

</div>

</div>

</div>

</div>

@endsection
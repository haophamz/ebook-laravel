@extends('layouts.quanli')

@include('includes.alert')

@section('styles')
@include('admin.partials.admin-ui')
@endsection

@section('content')

<div class="page-head">

    <div>

        <h1>Đơn hàng</h1>

        <p>Danh sách đơn hàng.</p>

    </div>

    <a href="{{ route('admin.revenue.index') }}" class="btn-edit">

        Quay lại

    </a>

</div>

<div class="card">

<table>

<thead>

<tr>

<th>Mã đơn</th>

<th>Khách hàng</th>

<th>Gói VIP</th>

<th>Thành tiền</th>

<th>Trạng thái</th>

<th>Ngày</th>

</tr>

</thead>

<tbody>

@foreach($orders as $order)

<tr>

<td>{{ $order->order_code }}</td>

<td>{{ $order->user?->name }}</td>

<td>{{ $order->vipPlan?->name }}</td>

<td>{{ number_format($order->final_amount) }}đ</td>

<td>

@if($order->status=='paid')

<span class="badge success">

Đã thanh toán

</span>

@else

<span class="badge warning">

Chờ thanh toán

</span>

@endif

</td>

<td>

{{ $order->created_at->format('d/m/Y H:i') }}

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

{{ $orders->links() }}

@endsection
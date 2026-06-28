@extends('layouts.quanli')

@include('includes.alert')

@section('styles')
@include('admin.partials.admin-ui')
@endsection

@section('content')

<div class="page-head">
    <div>
        <h1>Danh sách giao dịch</h1>
        <p>Các giao dịch thanh toán thành công.</p>
    </div>

    <a href="{{ route('admin.revenue.index') }}" class="btn-edit">
        Quay lại Dashboard
    </a>
</div>

<div class="card">

    <table>

        <thead>

        <tr>

            <th>ID</th>

            <th>Người dùng</th>

            <th>Số tiền</th>

            <th>Cổng</th>

            <th>Ngày</th>

        </tr>

        </thead>

        <tbody>

        @forelse($transactions as $item)

        <tr>

            <td>#{{ $item->id }}</td>

            <td>{{ $item->order?->user?->name ?? '-' }}</td>

            <td>{{ number_format($item->amount) }}đ</td>

            <td>{{ strtoupper($item->gateway) }}</td>

            <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>

        </tr>

        @empty

        <tr>

            <td colspan="5" style="text-align:center;padding:40px">

                Không có dữ liệu

            </td>

        </tr>

        @endforelse

        </tbody>

    </table>

</div>

{{ $transactions->links() }}

@endsection
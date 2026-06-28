@extends('layouts.quanli')

@include('includes.alert')

@section('styles')
@include('admin.partials.admin-ui')
@endsection

@section('content')

<div class="page-head">
    <div>
        <h1>Quản lý mã giảm giá</h1>
        <p>Quản lý tất cả coupon khuyến mãi.</p>
    </div>
</div>

<div class="card">

    <div class="table-head">

        <div>
            <h3>Danh sách Coupon</h3>
            <span>{{ $coupons->total() }} mã giảm giá</span>
        </div>

        <div style="display:flex;gap:12px;align-items:center;">

            <form method="GET" class="search-form">

                <input
                    type="text"
                    name="keyword"
                    value="{{ request('keyword') }}"
                    placeholder="Tìm mã hoặc tên...">

            </form>

            <a href="{{ route('admin.coupons.create') }}"
               class="btn-create">
                + Thêm Coupon
            </a>

        </div>

    </div>

    <div class="table-wrap">

        <table class="table">

            <thead>

            <tr>

                <th width="60">ID</th>

                <th>Mã</th>

                <th>Tên</th>

                <th>Loại</th>

                <th>Giá trị</th>

                <th>Số lượng / tài khoản</th>

                <th>Hết hạn</th>

                <th>Trạng thái</th>

                <th width="180">Thao tác</th>

            </tr>

            </thead>

            <tbody>

            @forelse($coupons as $coupon)

                <tr>

                    <td>#{{ $coupon->id }}</td>

                    <td>
                        <strong>{{ $coupon->code }}</strong>
                    </td>

                    <td>{{ $coupon->name }}</td>

                    <td>

                        @if($coupon->type=='percent')

                            {{ $coupon->value }}%

                        @else

                            Tiền

                        @endif

                    </td>

                    <td>

                        @if($coupon->type=='fixed')

                            {{ number_format($coupon->value) }}đ

                        @else

                            {{ $coupon->value }}%

                        @endif

                    </td>

                    <td>

                        {{ $coupon->used_count }}

                        /

                        {{ $coupon->usage_limit ?? '∞' }}

                    </td>

                    <td>

                        {{ $coupon->expired_at
                            ? $coupon->expired_at->format('d/m/Y')
                            : '--' }}

                    </td>

                    <td>

                        @if($coupon->active)

                            <span class="status-link status-active">
                                Hoạt động
                            </span>

                        @else

                            <span class="status-link status-locked">
                                Đã khóa
                            </span>

                        @endif

                    </td>

                    <td class="action-cell">

                        <div class="action-group">

                            <a href="{{ route('admin.coupons.edit',$coupon) }}"
                               class="btn-edit">

                                Sửa

                            </a>

                            <form action="{{ route('admin.coupons.destroy',$coupon) }}"
                                  method="POST"
                                  style="display:inline;">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn-delete"
                                    onclick="return confirm('Xóa mã giảm giá này?')">

                                    Xóa

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="9" class="text-center">

                        Chưa có mã giảm giá.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <div class="card-footer">

        {{ $coupons->links() }}

    </div>

</div>

@endsection
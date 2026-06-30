@extends('layouts.quanli')

@include('includes.alert')

@section('styles')
    @include('admin.partials.admin-ui')
@endsection

@section('content')

<div class="page-head">
    <div>
        <h1>Hỗ trợ khách hàng</h1>
        <p>Quản lý tất cả Ticket hỗ trợ từ người dùng.</p>
    </div>
</div>

<div class="card">

    <div class="table-head">

        <div>
            <h3>Danh sách Ticket</h3>
            <span>{{ $tickets->total() }} ticket</span>
        </div>

    </div>

    <table class="table">

        <thead>

        <tr>

            <th width="70">#</th>

            <th>Tiêu đề</th>

            <th>Người gửi</th>

            <th>Danh mục</th>

            <th>Trạng thái</th>

            <th>Ngày tạo</th>

            <th width="180">Thao tác</th>

        </tr>

        </thead>

        <tbody>

        @forelse($tickets as $ticket)

            <tr>

                <td>#{{ $ticket->id }}</td>

                <td>

                    <strong>{{ $ticket->title }}</strong>

                    @if($ticket->replies()->count())

                        <br>

                        <small style="color:#999">
                            {{ $ticket->replies()->count() }} phản hồi
                        </small>

                    @endif

                </td>

                <td>

                    {{ $ticket->user?->name ?? 'Khách' }}

                    <br>

                    <small style="color:#888">

                        {{ $ticket->email }}

                    </small>

                </td>

                <td>

                    @switch($ticket->category)

                        @case('payment')
                           Thanh toán
                            @break

                        @case('vip')
                             Hội viên
                            @break

                        @case('ebook')
                            Ebook
                            @break

                        @case('account')
                            Tài khoản
                            @break

                        @case('suggest')
                            Đề xuất
                            @break

                        @case('website')
                            Website
                            @break

                        @default
                           Khác

                    @endswitch

                </td>

                <td>

                    @switch($ticket->status)

                        @case('pending')

                            <span class="status inactive">

                                Chờ xử lý

                            </span>

                            @break

                        @case('processing')

                            <span class="status warning">

                                Đang xử lý

                            </span>

                            @break

                        @case('resolved')

                            <span class="status active">

                                Đã giải quyết

                            </span>

                            @break

                        @case('closed')

                            <span class="status">

                                Đã đóng

                            </span>

                            @break

                    @endswitch

                </td>

                <td>

                    {{ $ticket->created_at->format('d/m/Y') }}

                    <br>

                    <small style="color:#888">

                        {{ $ticket->created_at->format('H:i') }}

                    </small>

                </td>

                <td class="action-cell">

                    <div class="action-group">

                        <a href="{{ route('admin.support.show',$ticket) }}"
                           class="btn-edit">

                            Xem

                        </a>

                        <form action="{{ route('admin.support.destroy',$ticket) }}"
                              method="POST"
                              class="delete-form">

                            @csrf

                            @method('DELETE')

                            <button class="btn-delete">

                                Xóa

                            </button>

                        </form>

                    </div>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="7" style="padding:40px;text-align:center;color:#888;">

                    Chưa có Ticket hỗ trợ nào.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

    {{ $tickets->links() }}

</div>

@endsection
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
            <th width="220">Thao tác</th>
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

                <td>{{ $ticket->category_label }}</td>

                <td>
                    @switch($ticket->status)

                        @case('pending')
                            <span class="status inactive">Chờ xử lý</span>
                            @break

                        @case('processing')
                            <span class="status warning">Đang xử lý</span>
                            @break

                        @case('resolved')
                            <span class="status active">Đã giải quyết</span>
                            @break

                        @case('closed')
                            <span class="status">Đã đóng</span>
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

                        <a href="{{ route('admin.support.show', $ticket) }}"
                           class="btn-edit">
                            Xem
                        </a>

                        @if($ticket->status !== 'closed')

                            <form action="{{ route('admin.support.close', $ticket) }}"
                                  method="POST"
                                  class="close-ticket-form">

                                @csrf
                                @method('PATCH')

                                <button type="submit" class="btn-delete">
                                    Đóng
                                </button>

                            </form>

                        @else

                            <button type="button"
                                    class="btn-delete"
                                    disabled
                                    style="opacity:.5;cursor:not-allowed;">
                                Đã đóng
                            </button>

                        @endif

                        <form action="{{ route('admin.support.destroy', $ticket) }}"
                              method="POST"
                              class="delete-ticket-form">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn-delete">
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.querySelectorAll('.close-ticket-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Đóng Ticket?',
                text: 'Ticket sẽ được đóng ngay và email thông báo sẽ được gửi cho khách hàng.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#18c29c',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'Đóng Ticket',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    document.querySelectorAll('.delete-ticket-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            Swal.fire({
                title: 'Xóa Ticket?',
                text: 'Hành động này sẽ xóa ticket khỏi hệ thống.',
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

@endsection
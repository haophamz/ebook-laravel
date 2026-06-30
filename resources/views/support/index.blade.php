@extends('account.layout')

@include('includes.alert')

@section('account-content')

<h1 class="page-title">
    Ticket hỗ trợ
</h1>

<div class="bookshelf-grid">

    @forelse($tickets as $ticket)

        <div class="book-item">

            <div class="book-info">

                <div class="book-title">
                    {{ $ticket->title }}
                </div>

                <div class="book-meta">

                    @switch($ticket->category)

                        @case('payment')
                            💳 Thanh toán
                            @break

                        @case('vip')
                            👑 Hội viên VIP
                            @break

                        @case('ebook')
                            📚 Ebook
                            @break

                        @case('account')
                            👤 Tài khoản
                            @break

                        @default
                            ❓ Khác

                    @endswitch

                    •

                    {{ $ticket->created_at->format('d/m/Y H:i') }}

                </div>

                <div style="margin-top:10px;">

                    @switch($ticket->status)

                        @case('pending')
                            <span class="status waiting">
                                Chờ xử lý
                            </span>
                            @break

                        @case('processing')
                            <span class="status processing">
                                Đang xử lý
                            </span>
                            @break

                        @case('resolved')
                            <span class="status success">
                                Đã giải quyết
                            </span>
                            @break

                        @case('closed')
                            <span class="status closed">
                                Đã đóng
                            </span>
                            @break

                    @endswitch

                </div>

            </div>

            <div class="book-action">

                <a
                    href="{{ route('support.show',$ticket) }}"
                    class="btn-read">

                    Xem hội thoại

                </a>

            </div>

        </div>

    @empty

        <div class="empty-state">

            <h3>Chưa có Ticket nào</h3>

            <p>
                Khi bạn gửi yêu cầu hỗ trợ, Ticket sẽ hiển thị tại đây.
            </p>

        </div>

    @endforelse

</div>

<div style="margin-top:35px;">

    {{ $tickets->links() }}

</div>

<style>

.status{
    display:inline-block;
    padding:5px 12px;
    border-radius:30px;
    font-size:12px;
    font-weight:600;
}

.waiting{
    background:#fff8e1;
    color:#d97706;
}

.processing{
    background:#e0f2fe;
    color:#0284c7;
}

.success{
    background:#dcfce7;
    color:#16a34a;
}

.closed{
    background:#ececec;
    color:#666;
}

.book-item{
    display:flex;
    justify-content:space-between;
    align-items:center;
    background:#fff;
    border:1px solid #eee;
    border-radius:14px;
    padding:22px;
    margin-bottom:18px;
}

.book-title{
    font-size:18px;
    font-weight:700;
}

.book-meta{
    margin-top:8px;
    color:#777;
    font-size:14px;
}

.btn-read{
    padding:10px 22px;
    border-radius:8px;
    background:#18c29c;
    color:#fff;
    text-decoration:none;
    font-weight:600;
}

.btn-read:hover{
    opacity:.9;
}

.empty-state{
    text-align:center;
    padding:70px 20px;
}

.empty-state h3{
    margin-bottom:10px;
}

</style>

@endsection
@extends('account.layout')

@include('includes.alert')

@section('account-content')

<h1 class="page-title">
    Ticket hỗ trợ
</h1>

<div class="support-ticket-list">

    @forelse($tickets as $ticket)

        <div class="support-ticket-card">

            <div class="support-ticket-main">

                <div class="support-ticket-top">

                    <div class="support-ticket-title">
                        {{ $ticket->title }}
                    </div>

                    @switch($ticket->status)

                        @case('pending')
                            <span class="ticket-status status-waiting">
                                Chờ xử lý
                            </span>
                            @break

                        @case('processing')
                            <span class="ticket-status status-processing">
                                Đang xử lý
                            </span>
                            @break

                        @case('resolved')
                            <span class="ticket-status status-success">
                                Đã giải quyết
                            </span>
                            @break

                        @case('closed')
                            <span class="ticket-status status-closed">
                                Đã đóng
                            </span>
                            @break

                    @endswitch

                </div>

                <div class="support-ticket-meta">

                    <span>
                        @switch($ticket->category)

                            @case('payment')
                                Thanh toán
                                @break

                            @case('vip')
                                Hội viên VIP
                                @break

                            @case('ebook')
                                Ebook
                                @break

                            @case('account')
                                Tài khoản
                                @break

                            @default
                                Khác

                        @endswitch
                    </span>

                    <span class="dot"></span>

                    <span>
                        {{ $ticket->created_at->format('d/m/Y H:i') }}
                    </span>

                </div>

            </div>

            <div class="support-ticket-action">

                <a href="{{ route('support.show', $ticket) }}"
                   class="support-view-btn">
                    Xem hội thoại
                </a>

            </div>

        </div>

    @empty

        <div class="support-empty">

            <div class="support-empty-title">
                Chưa có Ticket nào
            </div>

            <p>
                Khi bạn gửi yêu cầu hỗ trợ, Ticket sẽ hiển thị tại đây.
            </p>

        </div>

    @endforelse

</div>

<div class="support-pagination">
    {{ $tickets->links() }}
</div>

<style>
    .support-ticket-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .support-ticket-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 22px;
        padding: 22px 24px;
        background: #ffffff;
        border: 1px solid #edf0f2;
        border-radius: 18px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, .05);
        transition: .22s ease;
    }

    .support-ticket-card:hover {
        border-color: rgba(24, 194, 156, .35);
        box-shadow: 0 16px 38px rgba(15, 23, 42, .08);
        transform: translateY(-2px);
    }

    .support-ticket-main {
        flex: 1;
        min-width: 0;
    }

    .support-ticket-top {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .support-ticket-title {
        font-size: 18px;
        line-height: 1.4;
        font-weight: 750;
        color: #1f2937;
    }

    .support-ticket-meta {
        margin-top: 9px;
        display: flex;
        align-items: center;
        gap: 9px;
        flex-wrap: wrap;
        color: #7b8491;
        font-size: 14px;
    }

    .dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: #c6ccd3;
        display: inline-block;
    }

    .ticket-status {
        display: inline-flex;
        align-items: center;
        height: 27px;
        padding: 0 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-waiting {
        background: #fff7ed;
        color: #c2410c;
    }

    .status-processing {
        background: #eff6ff;
        color: #2563eb;
    }

    .status-success {
        background: #ecfdf5;
        color: #15803d;
    }

    .status-closed {
        background: #f3f4f6;
        color: #4b5563;
    }

    .support-ticket-action {
        flex-shrink: 0;
    }

    .support-view-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 42px;
        padding: 0 20px;
        border-radius: 12px;
        background: #18c29c;
        color: #ffffff;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        box-shadow: 0 10px 22px rgba(24, 194, 156, .22);
        transition: .2s ease;
    }

    .support-view-btn:hover {
        color: #ffffff;
        background: #12ad8b;
        transform: translateY(-1px);
        box-shadow: 0 14px 26px rgba(24, 194, 156, .3);
    }

    .support-empty {
        background: #ffffff;
        border: 1px dashed #d7dde3;
        border-radius: 18px;
        padding: 72px 24px;
        text-align: center;
    }

    .support-empty-title {
        margin-bottom: 8px;
        color: #1f2937;
        font-size: 20px;
        font-weight: 750;
    }

    .support-empty p {
        margin: 0;
        color: #7b8491;
        font-size: 14px;
    }

    .support-pagination {
        margin-top: 32px;
    }

    @media (max-width: 768px) {
        .support-ticket-card {
            align-items: flex-start;
            flex-direction: column;
            padding: 20px;
        }

        .support-ticket-action,
        .support-view-btn {
            width: 100%;
        }
    }
</style>

@endsection
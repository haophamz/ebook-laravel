
@extends('layouts.quanli')

@include('includes.alert')

@section('styles')
    @include('admin.partials.admin-ui')
    <style>
        /* ==========================================================================
           CSS TÙY BIẾN PHÂN TRANG (CHỈ CẦN BLADE)
           ========================================================================== */
        
        /* Khung bọc ngoài để đẩy thanh phân trang sang góc phải */
        .pagination-wrapper {
            display: flex;
            justify-content: flex-end;
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid #edf2f7;
        }

        /* Định dạng danh sách các nút phân trang */
        .pagination-wrapper .pagination {
            display: flex;
            list-style: none;
            padding-left: 0;
            margin: 0;
        }

        /* Định dạng chung cho từng ô nút bấm */
        .pagination-wrapper .page-item .page-link {
            position: relative;
            display: block;
            padding: 8px 14px;
            margin-left: 5px;
            line-height: 1.25;
            color: #4a5568;
            background-color: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.15s ease-in-out;
        }

        /* Hiệu ứng khi rê chuột vào nút (Hover) */
        .pagination-wrapper .page-item .page-link:hover {
            background-color: #f7fafc;
            border-color: #cbd5e0;
            color: #1a202c;
        }

        /* Nút đang được chọn (Trang hiện tại) */
        .pagination-wrapper .page-item.active .page-link {
            z-index: 3;
            color: #fff;
            background-color: #3182ce; /* Màu xanh hiện đại, cao cấp */
            border-color: #3182ce;
        }

        /* Nút bị vô hiệu hóa (Ví dụ: Nút "Trước" khi đang ở trang 1) */
        .pagination-wrapper .page-item.disabled .page-link {
            color: #a0aec0;
            pointer-events: none;
            background-color: #f7fafc;
            border-color: #e2e8f0;
        }
        
        /* Thêm tí style cho badge tên gói VIP nhìn xịn hơn */
        .badge-vip {
            background-color: #ebf8ff;
            color: #2b6cb0;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 600;
        }
    </style>
@endsection

@section('content')

<div class="page-head">
    <div>
        <h1>Đơn hàng</h1>
        <p>Danh sách đơn hàng đã tạo trong hệ thống.</p>
    </div>

    <a href="{{ route('admin.revenue.index') }}" class="btn-edit">
        Quay lại
    </a>
</div>

<div class="card">

    <div class="table-head">
        <div>
            <h3>Danh sách đơn hàng</h3>
            <span>{{ $orders->total() }} đơn hàng</span>
        </div>
    </div>

    <table class="table">

        <thead>
            <tr>
                <th width="170">Mã đơn</th>
                <th>Khách hàng</th>
                <th>Gói VIP</th>
                <th width="150">Thành tiền</th>
                <th width="160">Trạng thái</th>
                <th width="180">Ngày tạo</th>
            </tr>
        </thead>

        <tbody>

            @forelse($orders as $order)

                <tr>
                    <td><strong>{{ $order->order_code }}</strong></td>

                    <td>{{ $order->user?->name ?? '-' }}</td>

                    <td>
                        @if($order->vipPlan?->name)
                            <span class="badge-vip">{{ $order->vipPlan->name }}</span>
                        @else
                            -
                        @endif
                    </td>

                    <td><strong style="color: #2d3748;">{{ number_format($order->final_amount) }}đ</strong></td>

                    <td>
                        @if($order->status == 'paid')
                            <span class="status active">
                                Đã thanh toán
                            </span>
                        @else
                            <span class="status inactive">
                                Chờ thanh toán
                            </span>
                        @endif
                    </td>

                    <td>
                        {{ $order->created_at->format('d/m/Y H:i') }}
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="6" style="text-align:center;padding:40px;color:#888;">
                        Chưa có đơn hàng nào.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

    <div class="pagination-wrapper">
        {{ $orders->links('pagination::bootstrap-4') }}
    </div>

</div>

@endsection


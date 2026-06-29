
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
            background-color: #3182ce; /* Màu xanh hiện đại */
            border-color: #3182ce;
        }

        /* Nút bị vô hiệu hóa */
        .pagination-wrapper .page-item.disabled .page-link {
            color: #a0aec0;
            pointer-events: none;
            background-color: #f7fafc;
            border-color: #e2e8f0;
        }
    </style>
@endsection

@section('content')

<div class="page-head">
    <div>
        <h1>Người dùng</h1>
        <p>Danh sách thành viên.</p>
    </div>

    <a href="{{ route('admin.revenue.index') }}" class="btn-edit">
        Quay lại
    </a>
</div>

<div class="card">
    <table class="table">
        <thead>
            <tr>
                <th width="80">ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th width="150">VIP</th>
                <th width="180">Ngày tạo</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td><strong>#{{ $user->id }}</strong></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->membership_type == 'vip')
                            <span class="badge success">
                                VIP
                            </span>
                        @else
                            <span class="badge">
                                FREE
                            </span>
                        @endif
                    </td>
                    <td>
                        {{ $user->created_at->format('d/m/Y') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center;padding:40px;color:#888;">
                        Chưa có người dùng nào trong hệ thống.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination-wrapper">
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection


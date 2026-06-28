@extends('layouts.quanli')

@include('includes.alert')

@section('styles')
@include('admin.partials.admin-ui')
<style>
/* Tối ưu hóa biến màu và phông nền tổng thể */
:root {
    --primary-green: #10b981;
    --primary-hover: #059669;
    --bg-light: #f9fafb;
    --text-dark: #111827;
    --text-muted: #6b7280;
    --border-color: #f3f4f6;
}

body {
    background-color: var(--bg-light);
}

.page-head {
    margin-bottom: 28px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--border-color);
}

.page-head h1 {
    font-size: 26px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 4px;
}

.page-head p {
    color: var(--text-muted);
    font-size: 14px;
}

/* Stats Card Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 25px;
}

.stat-card {
    background: #fff;
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 24px;
    position: relative;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(16, 185, 129, 0.08);
    border-color: rgba(16, 185, 129, 0.2);
}

.stat-flex {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.stat-title {
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: var(--text-muted);
    margin-bottom: 12px;
}

.stat-value {
    font-size: 28px;
    font-weight: 700;
    color: var(--text-dark);
    letter-spacing: -0.5px;
}

.stat-icon {
    background: #ecfdf5;
    color: var(--primary-green);
    padding: 10px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Card lớn (Biểu đồ & Bảng) */
.custom-card {
    background: #fff;
    border: 1px solid var(--border-color);
    border-radius: 16px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
    margin-bottom: 25px;
    overflow: hidden;
}

.table-head {
    padding: 20px 24px;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.table-head h3 {
    font-size: 18px;
    font-weight: 600;
    color: var(--text-dark);
}

/* Khu vực biểu đồ */
.chart-box {
    height: 380px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-muted);
    font-size: 15px;
    background: linear-gradient(to bottom, #ffffff, #fafafa);
    font-style: italic;
}

/* Tối ưu hóa bảng dữ liệu */
.table-responsive {
    overflow-x: auto;
}

.modern-table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
}

.modern-table th {
    background: #f8fafc;
    padding: 14px 24px;
    font-size: 13px;
    font-weight: 600;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.modern-table td {
    padding: 16px 24px;
    font-size: 14px;
    color: #374151;
    border-bottom: 1px solid var(--border-color);
    vertical-align: middle;
}

.modern-table tr:last-child td {
    border-bottom: none;
}

.modern-table tr:hover td {
    background-color: #fcfdfd;
}

/* Badges hiện đại */
.badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 6px 12px;
    border-radius: 9999px;
    font-size: 12px;
    font-weight: 600;
}

.badge.success {
    background-color: #d1fae5;
    color: #065f46;
}

.badge.warning {
    background-color: #fef3c7;
    color: #92400e;
}

.badge.danger {
    background-color: #fee2e2;
    color: #991b1b;
}

/* Responsive */
@media(max-width:1100px){
    .stats-grid{
        grid-template-columns: repeat(2, 1fr);
    }
}

@media(max-width:600px){
    .stats-grid{
        grid-template-columns: 1fr;
    }
    .modern-table th, .modern-table td {
        padding: 12px 16px;
    }
}
</style>
@endsection

@section('content')

<div class="page-head">
    <div>
        <h1>Doanh thu</h1>
        <p>Tổng quan hoạt động kinh doanh và dữ liệu hệ thống EcoBook.</p>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-flex">
            <div>
                <div class="stat-title">Doanh thu hôm nay</div>
                <div class="stat-value">{{ number_format($todayRevenue) }}đ</div>
            </div>
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-flex">
            <div>
                <div class="stat-title">Doanh thu tháng</div>
                <div class="stat-value">{{ number_format($monthRevenue) }}đ</div>
            </div>
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-flex">
            <div>
                <div class="stat-title">Doanh thu năm</div>
                <div class="stat-value">{{ number_format($yearRevenue) }}đ</div>
            </div>
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path></svg>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-flex">
            <div>
                <div class="stat-title">Tổng doanh thu</div>
                <div class="stat-value" style="color: var(--primary-green);">{{ number_format($totalRevenue) }}đ</div>
            </div>
            <div class="stat-icon" style="background: #10b981; color: #fff;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"></path><path d="M2 17l10 5 10-5"></path><path d="M2 12l10 5 10-5"></path></svg>
            </div>
        </div>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-flex">
            <div>
                <div class="stat-title">Tổng đơn hàng</div>
                <div class="stat-value">{{ number_format($totalOrders) }}</div>
            </div>
            <div class="stat-icon" style="background:#eff6ff; color:#3b82f6;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-flex">
            <div>
                <div class="stat-title">Đã thanh toán</div>
                <div class="stat-value">{{ number_format($paidOrders) }}</div>
            </div>
            <div class="stat-icon" style="background:#ecfdf5; color:#10b981;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-flex">
            <div>
                <div class="stat-title">Người dùng</div>
                <div class="stat-value">{{ number_format($totalUsers) }}</div>
            </div>
            <div class="stat-icon" style="background:#f5f3ff; color:#8b5cf6;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </div>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-flex">
            <div>
                <div class="stat-title">Thành viên VIP</div>
                <div class="stat-value" style="color: #b45309;">{{ number_format($vipUsers) }}</div>
            </div>
            <div class="stat-icon" style="background:#fffbeb; color:#f59e0b;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
            </div>
        </div>
    </div>
</div>

<div class="custom-card">
    <div class="table-head">
        <h3>Biểu đồ doanh thu 30 ngày</h3>
    </div>
    <div style="padding:25px; height:400px; position: relative;">
        <canvas id="revenueChart"></canvas>
    </div>
</div>

<div class="custom-card">
    <div class="table-head">
        <h3>Giao dịch gần đây</h3>
    </div>
    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Người dùng</th>
                    <th>Số tiền</th>
                    <th>Trạng thái</th>
                    <th>Ngày giao dịch</th>
                </tr>
            </thead>
            <tbody>
                @forelse($latestTransactions as $item)
                <tr>
                    <td style="font-weight: 600; color: var(--text-dark);">
                        #{{ $item->id }}
                    </td>
                    <td>
                        <span style="font-weight: 500;">{{ optional(optional($item->order)->user)->name ?? '-' }}</span>
                    </td>
                    <td style="font-weight: 600; color: var(--text-dark);">
                        {{ number_format($item->amount) }}đ
                    </td>
                    <td>
                        @if($item->status=='success')
                            <span class="badge success">Đã thanh toán</span>
                        @elseif($item->status=='pending')
                            <span class="badge warning">Chờ thanh toán</span>
                        @else
                            <span class="badge danger">Thất bại</span>
                        @endif
                    </td>
                    <td style="color: var(--text-muted);">
                        {{ $item->created_at->format('d/m/Y H:i') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center; padding:50px 0; color: var(--text-muted);">
                        <div style="margin-bottom: 8px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="color: #d1d5db;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                        </div>
                        Chưa có giao dịch nào được ghi nhận.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('revenueChart').getContext('2d');
const chartLabels = (@json($chart->pluck('date')));
const chartData = (@json($chart->pluck('total')));

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Doanh thu (đ)',
                    data: chartData,
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.3,
                    pointBackgroundColor: '#10b981',
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f3f4f6'
                        },
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString('vi-VN') + 'đ';
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
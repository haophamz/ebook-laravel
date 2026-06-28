<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use App\Models\VipPlan;

class RevenueController extends Controller
{
    public function index()
    {
        $todayRevenue = Transaction::where('status', 'success')
            ->whereDate('created_at', today())
            ->sum('amount');

        $monthRevenue = Transaction::where('status', 'success')
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('amount');

        $yearRevenue = Transaction::where('status', 'success')
            ->whereYear('created_at', now()->year)
            ->sum('amount');

        $totalRevenue = Transaction::where('status', 'success')
            ->sum('amount');

        $totalOrders = Order::count();

        $paidOrders = Order::where('status', 'paid')->count();

        $totalUsers = User::count();

        $vipUsers = User::where('membership_type', 'vip')->count();

$latestTransactions = Transaction::with('order.user')
    ->latest()
    ->take(10)
    ->get();
$chart = Transaction::selectRaw("
        DATE(created_at) as date,
        SUM(amount) as total
    ")
    ->where('status', 'success')
    ->whereDate('created_at', '>=', now()->subDays(29))
    ->groupByRaw('DATE(created_at)')
    ->orderByRaw('DATE(created_at)')
    ->get();

return view('admin.revenue.index', compact(
    'todayRevenue',
    'monthRevenue',
    'yearRevenue',
    'totalRevenue',
    'totalOrders',
    'paidOrders',
    'totalUsers',
    'vipUsers',
    'latestTransactions',
    'chart'
));
}
}
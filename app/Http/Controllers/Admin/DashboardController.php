<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function transactions(Request $request)
    {
        $query = Transaction::with('order.user')
            ->where('status', 'success');

        switch ($request->range) {

            case 'today':
                $query->whereDate('created_at', today());
                break;

            case 'month':
                $query->whereYear('created_at', now()->year)
                      ->whereMonth('created_at', now()->month);
                break;

            case 'year':
                $query->whereYear('created_at', now()->year);
                break;
        }

        $transactions = $query
            ->latest()
            ->paginate(20);

        return view(
            'admin.dashboard.transactions',
            compact('transactions')
        );
    }

    public function orders(Request $request)
    {
        $query = Order::query();

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );

        }

        $orders = $query
            ->latest()
            ->paginate(20);

        return view(
            'admin.dashboard.orders',
            compact('orders')
        );
    }

    public function users(Request $request)
    {
        $query = User::query();

        if ($request->vip) {

            $query->where(
                'membership_type',
                'vip'
            );

        }

        $users = $query
            ->latest()
            ->paginate(20);

        return view(
            'admin.dashboard.users',
            compact('users')
        );
    }
}
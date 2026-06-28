<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $coupons = Coupon::when($keyword, function ($query) use ($keyword) {
                $query->where('code', 'like', "%{$keyword}%")
                      ->orWhere('name', 'like', "%{$keyword}%");
            })
            ->latest()
            ->paginate(15);

        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|max:255|unique:coupons,code',
            'name' => 'required|string|max:255',
            'type' => 'required|in:percent,fixed',
            'value' => 'required|numeric|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'started_at' => 'nullable|date',
            'expired_at' => 'nullable|date|after_or_equal:started_at',
            'active' => 'nullable|boolean',
        ]);

        $data['active'] = $request->boolean('active');

        Coupon::create($data);

        return redirect()
            ->route('admin.coupons.index')
            ->with('success', 'Tạo mã giảm giá thành công.');
    }

    public function show(Coupon $coupon)
    {
        abort(404);
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $data = $request->validate([
            'code' => 'required|string|max:255|unique:coupons,code,' . $coupon->id,
            'name' => 'required|string|max:255',
            'type' => 'required|in:percent,fixed',
            'value' => 'required|numeric|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'max_discount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'started_at' => 'nullable|date',
            'expired_at' => 'nullable|date|after_or_equal:started_at',
            'active' => 'nullable|boolean',
        ]);

        $data['active'] = $request->boolean('active');

        $coupon->update($data);

        return redirect()
            ->route('admin.coupons.index')
            ->with('success', 'Cập nhật mã giảm giá thành công.');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return back()->with('success', 'Đã xóa mã giảm giá.');
    }
}
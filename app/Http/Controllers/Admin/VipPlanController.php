<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VipPlan;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Transaction;

class VipPlanController extends Controller
{
    public function index()
    {
        $plans = VipPlan::latest()->paginate(20);

        return view(
            'admin.vip-plans.index',
            compact('plans')
        );
    }

    public function create()
    {
        return view(
            'admin.vip-plans.create'
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'months' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        VipPlan::create([
            'name' => $request->name,
            'months' => $request->months,
            'price' => $request->price,
            'description' => $request->description,
            'active' => $request->has('active'),
            'is_popular' => $request->has('is_popular'),
        ]);

        return redirect()
            ->route('admin.vip-plans.index')
            ->with('success','Đã thêm gói');
    }

    public function edit(VipPlan $vip_plan)
    {
        return view(
            'admin.vip-plans.edit',
            compact('vip_plan')
        );
    }

    public function update(
        Request $request,
        VipPlan $vip_plan
    ){
        $vip_plan->update([
            'name' => $request->name,
            'months' => $request->months,
            'price' => $request->price,
            'description' => $request->description,
            'active' => $request->has('active'),
            'is_popular' => $request->has('is_popular'),
        ]);

        return redirect()
            ->route('admin.vip-plans.index')
            ->with('success','Đã cập nhật');
    }

    public function destroy(VipPlan $vip_plan)
    {
        $vip_plan->delete();

        return back()
            ->with('success','Đã xóa');
    }
    //user goi
    public function pricing()
{
    $plans = VipPlan::where('active',1)
        ->orderBy('months')
        ->get();

    return view(
        'home.pricing',
        compact('plans')
    );
}
public function subscribe(Request $request)
{
    $plan = VipPlan::findOrFail(
        $request->plan_id
    );

    $order = Order::create([

        'user_id' => auth()->id(),

        'vip_plan_id' => $plan->id,

        'order_code' => 'HIKI'.time(),

        'amount' => $plan->price,

        'discount' => 0,

        'final_amount' => $plan->price,

        'payment_method' => 'vietqr',

        'status' => 'pending',
    ]);

    return redirect()
        ->route('vip.checkout',$order);
}
public function checkout(Order $order)
{
    return view(
        'vip.checkout',
        compact('order')
    );
}
}
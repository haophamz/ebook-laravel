<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query();

        if ($request->filled('keyword')) {

            $keyword = $request->keyword;

            $users->where(function ($query) use ($keyword) {

                $query->where('name', 'like', "%{$keyword}%")
                      ->orWhere('email', 'like', "%{$keyword}%");

            });
        }

        if ($request->type == 'vip') {
            $users->where('membership_type', 'vip');
        }

        if ($request->type == 'free') {
            $users->where('membership_type', 'free');
        }

        if ($request->type == 'active') {
            $users->where('is_active', 1);
        }

        if ($request->type == 'locked') {
            $users->where('is_active', 0);
        }

        $users = $users->latest()->paginate(20);

        return view('admin.members.index', compact('users'));
    }

    /**
     * Hiển thị form sửa thông tin hội viên.
     */
    public function edit(User $member)
    {
        return view('admin.members.edit', [
            'user' => $member,
        ]);
    }

    /**
     * Cập nhật thông tin hội viên (dùng cho form sửa đầy đủ ở trang edit).
     */
    public function update(Request $request, User $member)
    {
        $isVip = $request->membership_type === 'vip';

        $validated = $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|email|max:255|unique:users,email,' . $member->id,
            'membership_type'  => 'required|in:vip,free',
            'vip_expires_at'   => [
                $isVip ? 'required' : 'nullable',
                'date',
                $isVip ? 'after:today' : 'nullable',
            ],
        ], [
            'vip_expires_at.required' => 'Vui lòng nhập hạn VIP cho tài khoản VIP.',
            'vip_expires_at.after'    => 'Hạn VIP phải lớn hơn ngày hiện tại.',
        ]);

        $member->update($validated);

        return redirect()
            ->route('admin.members.index')
            ->with('success', 'Đã cập nhật hội viên.');
    }

    /**
     * Khóa tài khoản hội viên (is_active = 0).
     * Gọi qua route riêng admin.members.lock.
     */
    public function lock(User $member)
    {
        $member->update(['is_active' => 0]);

        return back()->with('success', 'Đã khóa tài khoản: ' . $member->name);
    }

    /**
     * Mở khóa tài khoản hội viên (is_active = 1).
     * Gọi qua route riêng admin.members.unlock.
     */
    public function unlock(User $member)
    {
        $member->update(['is_active' => 1]);

        return back()->with('success', 'Đã mở khóa tài khoản: ' . $member->name);
    }
}
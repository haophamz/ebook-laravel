<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportReply;
use App\Models\SupportTicket;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    /**
     * Danh sách ticket
     */
    public function index()
    {
        $tickets = SupportTicket::latest()->paginate(20);

        return view('admin.support.index', compact('tickets'));
    }

    /**
     * Chi tiết ticket
     */
    public function show(SupportTicket $support)
    {
        $replies = $support->replies()
            ->with('user')
            ->oldest()
            ->get();

        return view('admin.support.show', [
            'ticket' => $support,
            'replies' => $replies,
        ]);
    }

    /**
     * Trả lời ticket
     */
    public function update(Request $request, SupportTicket $support)
    {
        $request->validate([
            'message' => 'required|string',
            'image'   => 'nullable|image|max:5120',
            'status'  => 'nullable|in:pending,processing,resolved,closed',
        ]);

        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')
                ->store('support', 'public');
        }

        SupportReply::create([
            'ticket_id' => $support->id,
            'user_id'   => auth()->id(),
            'is_admin'  => true,
            'message'   => $request->message,
            'image'     => $image,
        ]);

        $support->update([
            'status' => $request->status ?? 'processing',
            'last_reply_at' => now(),
        ]);

        return back()->with(
            'success',
            'Đã gửi phản hồi.'
        );
    }

    /**
     * Xóa ticket
     */
    public function destroy(SupportTicket $support)
    {
        $support->delete();

        return redirect()
            ->route('admin.support.index')
            ->with('success', 'Đã xóa ticket.');
    }
    public function reply(Request $request, SupportTicket $support)
{
    $request->validate([
        'message' => 'required|string',
        'image'   => 'nullable|image|max:5120',
        'status'  => 'nullable|in:pending,processing,resolved,closed',
    ]);

    $image = null;

    if ($request->hasFile('image')) {
        $image = $request->file('image')
            ->store('support', 'public');
    }

    SupportReply::create([
        'ticket_id' => $support->id,
        'user_id'   => auth()->id(),
        'is_admin'  => true,
        'message'   => $request->message,
        'image'     => $image,
    ]);

    $support->update([
        'status' => $request->status ?? 'processing',
        'last_reply_at' => now(),
    ]);

    return back()->with('success', 'Đã gửi phản hồi.');
}
}
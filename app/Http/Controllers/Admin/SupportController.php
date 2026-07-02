<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\TicketReplyMail;
use App\Models\SupportReply;
use App\Models\SupportTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketClosedMail;
class SupportController extends Controller
{
    public function index()
    {
        $tickets = SupportTicket::latest()->paginate(20);

        return view('admin.support.index', compact('tickets'));
    }

    public function show(SupportTicket $support)
    {
        $replies = $support->replies()
            ->with('user')
            ->oldest()
            ->get();

        return view('admin.support.show', [
            'ticket'  => $support,
            'replies' => $replies,
        ]);
    }

    public function update(Request $request, SupportTicket $support)
    {
        return $this->adminReply($request, $support);
    }

    public function reply(Request $request, SupportTicket $support)
    {
        return $this->adminReply($request, $support);
    }

    private function adminReply(Request $request, SupportTicket $support)
    {
        $request->validate([
            'message' => 'required|string|max:5000',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
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

        if ($support->notify_user) {
            Mail::to($support->email)
                ->send(new TicketReplyMail($support));
        }

        $support->update([
            'status'        => $request->status ?? 'processing',
            'notify_user'   => false,
            'last_reply_by' => 'admin',
            'last_reply_at' => now(),
        ]);

        return back()->with('success', 'Đã gửi phản hồi.');
    }
public function close(SupportTicket $support)
{
    if ($support->status === 'closed') {
        return back()->with('success', 'Ticket này đã được đóng trước đó.');
    }

    $support->update([
        'status'    => 'closed',
        'closed_at' => now(),
    ]);

    Mail::to($support->email)
        ->send(new TicketClosedMail($support));

    return back()->with(
        'success',
        'Đã đóng ticket và gửi email thông báo cho khách hàng.'
    );
}
    public function destroy(SupportTicket $support)
    {
        $support->delete();

        return redirect()
            ->route('admin.support.index')
            ->with('success', 'Đã xóa ticket.');
    }
}
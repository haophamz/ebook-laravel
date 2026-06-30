<?php

namespace App\Http\Controllers;

use App\Models\SupportTicket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\SupportReply;
class SupportTicketController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email'       => ['required', 'email', 'max:255'],
            'title'       => ['required', 'string', 'max:255'],
            'category'    => ['required', 'in:payment,vip,ebook,account,other'],
            'description' => ['required', 'string', 'max:5000'],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'], // 5MB
        ], [
            'email.required'       => 'Vui lòng nhập email liên hệ.',
            'email.email'          => 'Email không hợp lệ.',
            'title.required'       => 'Vui lòng nhập tiêu đề yêu cầu.',
            'category.required'    => 'Vui lòng chọn danh mục hỗ trợ.',
            'category.in'          => 'Danh mục không hợp lệ.',
            'description.required' => 'Vui lòng mô tả chi tiết vấn đề.',
            'image.image'          => 'File phải là hình ảnh.',
            'image.mimes'          => 'Chỉ hỗ trợ định dạng JPG, PNG, WEBP.',
            'image.max'            => 'Hình ảnh tối đa 5MB.',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Lưu vào storage/app/public/tickets, nhớ chạy: php artisan storage:link
            $imagePath = $request->file('image')->store('tickets', 'public');
        }

        SupportTicket::create([
            'user_id'     => auth()->id(), // null nếu chưa đăng nhập
            'email'       => $validated['email'],
            'title'       => $validated['title'],
            'category'    => $validated['category'],
            'description' => $validated['description'],
            'image_path'  => $imagePath,
            'status'      => 'pending',
        ]);

        return back()->with('ticket_success', 'Gửi yêu cầu hỗ trợ thành công! Chúng tôi sẽ phản hồi sớm nhất.');
    }

public function reply(Request $request, SupportTicket $ticket)
{
    abort_if($ticket->user_id != auth()->id(), 403);

    $request->validate([
        'message' => 'required',
        'image' => 'nullable|image|max:5120'
    ]);

    $image = null;

    if($request->hasFile('image')){
        $image = $request->file('image')
            ->store('support','public');
    }

    SupportReply::create([

        'ticket_id' => $ticket->id,

        'user_id' => auth()->id(),

        'is_admin' => false,

        'message' => $request->message,

        'image' => $image,

    ]);

    $ticket->update([
        'status' => 'pending',
        'last_reply_at' => now(),
    ]);

    return back()
        ->with('success','Đã gửi phản hồi.');
}
public function index()
{
    // Retrieve the current user's tickets
    $tickets = SupportTicket::where('user_id', auth()->id())
        ->latest()
       ->paginate(10);

    return view('support.index', compact('tickets'));
}
public function show($id)
{
    $ticket = SupportTicket::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $replies = SupportReply::where('ticket_id', $ticket->id)
        ->with('user')
        ->orderBy('created_at')
        ->get();

    return view('support.show', compact(
        'ticket',
        'replies'
    ));
}
public function messages(Request $request, SupportTicket $ticket)
{
    $user = $request->user();

    if (!$user) {
        abort(403);
    }

    // Nếu không phải admin thì chỉ được xem ticket của mình
    if (!$user->is_admin && $ticket->user_id != $user->id) {
        abort(403);
    }

    $replies = $ticket->replies()
        ->with('user:id,name')
        ->orderBy('id')
        ->get()
        ->map(function ($reply) use ($ticket) {

            return [

                'id' => $reply->id,

                'is_admin' => (bool) $reply->is_admin,

                'author' => $reply->is_admin
                    ? ($reply->user?->name ?? 'EcoBook Support')
                    : ($ticket->user?->name ?? 'Khách hàng'),

                'message' => $reply->message,

                'image_url' => $reply->image
                    ? asset('storage/'.$reply->image)
                    : null,

                'time' => $reply->created_at->format('H:i d/m/Y'),

            ];

        });

    return response()->json([
        'replies' => $replies,
        'status' => $ticket->status,
    ]);
}
}
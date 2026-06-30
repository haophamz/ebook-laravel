@extends('layouts.app') {{-- đổi tên layout cho khớp project của bạn --}}

@section('content')
<style>
    .chat-wrap {
        max-width: 720px;
        margin: 24px auto;
        font-family: 'Segoe UI', sans-serif;
        color: #222;
        padding: 0 16px;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: #5a6885;
        text-decoration: none;
        margin-bottom: 12px;
    }
    .back-link:hover { color: #27ae60; }

    /* ===== Header ticket ===== */
    .chat-header {
        background: #fff;
        border: 1px solid #e6e8eb;
        border-radius: 14px 14px 0 0;
        padding: 18px 22px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }
    .chat-header .info h2 { margin: 0 0 4px; font-size: 17px; color: #1d2129; }
    .chat-header .meta { font-size: 12.5px; color: #8a93a3; display: flex; gap: 14px; flex-wrap: wrap; }

    .badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
    }
    .badge-pending     { background: #fff4e0; color: #b9770e; }
    .badge-processing  { background: #e3f2fd; color: #1976d2; }
    .badge-resolved    { background: #e6f9ee; color: #1e8449; }
    .badge-closed      { background: #f1f2f4; color: #6b7178; }

    .badge-cat {
        background: #eef1f6; color: #5a6885;
        padding: 4px 10px; border-radius: 999px; font-size: 12px;
    }

    /* ===== Khung chat ===== */
    .chat-box {
        background: #f7f8fa;
        border-left: 1px solid #e6e8eb;
        border-right: 1px solid #e6e8eb;
        padding: 24px 22px;
        min-height: 280px;
        max-height: 560px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .bubble-row { display: flex; flex-direction: column; max-width: 78%; margin-bottom: 10px; }
    .bubble-row.from-me    { align-self: flex-end; align-items: flex-end; }
    .bubble-row.from-admin { align-self: flex-start; align-items: flex-start; }

    .bubble-author { font-size: 11.5px; color: #9aa3ad; margin-bottom: 4px; padding: 0 4px; }

    .bubble {
        padding: 11px 15px;
        border-radius: 16px;
        font-size: 14px;
        line-height: 1.55;
        white-space: pre-line;
        word-break: break-word;
    }
    .from-admin .bubble {
        background: #fff;
        border: 1px solid #e6e8eb;
        color: #2c2c2c;
        border-bottom-left-radius: 4px;
    }
    .from-me .bubble {
        background: linear-gradient(120deg, #2ecc71, #16a085);
        color: #fff;
        border-bottom-right-radius: 4px;
    }

    .bubble-img {
        margin-top: 6px;
        max-width: 220px;
        border-radius: 12px;
        border: 1px solid #e6e8eb;
        display: block;
        cursor: zoom-in;
    }

    .bubble-time { font-size: 10.5px; color: #b3b9c2; margin-top: 4px; padding: 0 4px; }

    /* ===== Form trả lời ===== */
    .chat-footer {
        background: #fff;
        border: 1px solid #e6e8eb;
        border-radius: 0 0 14px 14px;
        padding: 18px 22px;
    }
    .chat-footer textarea {
        width: 100%;
        min-height: 70px;
        resize: vertical;
        border: 1px solid #dfe2e6;
        border-radius: 10px;
        padding: 12px 14px;
        font-size: 14px;
        font-family: inherit;
        outline: none;
        box-sizing: border-box;
        transition: border-color .15s, box-shadow .15s;
    }
    .chat-footer textarea:focus { border-color: #27ae60; box-shadow: 0 0 0 3px rgba(39,174,96,0.12); }
    .chat-footer textarea:disabled { background: #f3f4f6; color: #999; }

    .chat-footer-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 12px;
        gap: 12px;
        flex-wrap: wrap;
    }

    .file-label {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: #5a6885;
        cursor: pointer;
        border: 1px dashed #cfd4db;
        padding: 7px 12px;
        border-radius: 8px;
        transition: border-color .15s, color .15s;
    }
    .file-label:hover { border-color: #27ae60; color: #1e8449; }
    .file-label input { display: none; }
    .file-name { font-size: 12px; color: #27ae60; }

    .btn-send {
        background: linear-gradient(120deg, #2ecc71, #16a085);
        color: #fff;
        border: none;
        padding: 10px 26px;
        border-radius: 9px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: filter .15s;
        margin-left: auto;
    }
    .btn-send:hover { filter: brightness(1.07); }

    .closed-note {
        text-align: center;
        font-size: 13px;
        color: #9aa3ad;
        padding: 6px 0 2px;
    }

    .alert-success {
        background: #e6f9ee; color: #1e8449; border: 1px solid #b6ecca;
        padding: 10px 14px; border-radius: 10px; font-size: 13.5px; margin-bottom: 16px;
    }
</style>

<div class="chat-wrap">

    <a href="{{ route('support.index') }}" class="back-link">&larr; Quay lại danh sách yêu cầu</a>

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    {{-- Header --}}
    <div class="chat-header">
        <div class="info">
            <h2>#{{ $ticket->id }} — {{ $ticket->title }}</h2>
            <div class="meta">
                <span class="badge-cat">{{ \App\Models\SupportTicket::CATEGORIES[$ticket->category] ?? $ticket->category }}</span>
                <span class="badge badge-{{ $ticket->status }}">{{ \App\Models\SupportTicket::STATUSES[$ticket->status] ?? $ticket->status }}</span>
                <span>Tạo lúc {{ $ticket->created_at->format('H:i d/m/Y') }}</span>
            </div>
        </div>
    </div>

    {{-- Khung chat --}}
    <div class="chat-box" id="chatBox">

        {{-- Tin nhắn gốc của bạn --}}
        <div class="bubble-row from-me">
            <div class="bubble-author">Bạn</div>
            <div class="bubble">{{ $ticket->description }}</div>
            @if ($ticket->image_path)
                <a href="{{ asset('storage/' . $ticket->image_path) }}" target="_blank">
                    <img src="{{ asset('storage/' . $ticket->image_path) }}" class="bubble-img">
                </a>
            @endif
            <div class="bubble-time">{{ $ticket->created_at->format('H:i d/m/Y') }}</div>
        </div>

        {{-- Các phản hồi tiếp theo --}}
        @foreach ($replies as $reply)
            <div class="bubble-row {{ $reply->is_admin ? 'from-admin' : 'from-me' }}">
                <div class="bubble-author">
                    {{ $reply->is_admin ? ($reply->user->name ?? 'Đội ngũ hỗ trợ') : 'Bạn' }}
                </div>
                <div class="bubble">{{ $reply->message }}</div>
                @if ($reply->image)
                    <a href="{{ asset('storage/' . $reply->image) }}" target="_blank">
                        <img src="{{ asset('storage/' . $reply->image) }}" class="bubble-img">
                    </a>
                @endif
                <div class="bubble-time">{{ $reply->created_at->format('H:i d/m/Y') }}</div>
            </div>
        @endforeach

    </div>

    {{-- Form trả lời --}}
    <div class="chat-footer">
        @if (in_array($ticket->status, ['closed']))
            <p class="closed-note">Yêu cầu này đã được đóng, vui lòng tạo yêu cầu mới nếu cần hỗ trợ thêm.</p>
        @else
            <form action="{{ route('support.reply', $ticket->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <textarea name="message" placeholder="Nhập phản hồi của bạn..." required>{{ old('message') }}</textarea>
                @error('message') <div style="color:#e74c3c;font-size:12.5px;margin-top:6px;">{{ $message }}</div> @enderror

                <div class="chat-footer-row">
                    <label class="file-label">
                        Đính kèm ảnh
                        <input type="file" name="image" accept="image/jpeg,image/png,image/webp" id="replyImage">
                    </label>
                    <span class="file-name" id="replyImageName"></span>

                    <button type="submit" class="btn-send">Gửi</button>
                </div>
            </form>
        @endif
    </div>
</div>

<script>

const replyImage = document.getElementById('replyImage');

if(replyImage){

    replyImage.addEventListener('change',function(){

        document.getElementById('replyImageName').textContent =
            this.files.length ? this.files[0].name : '';

    });

}

const chatBox = document.getElementById('chatBox');

if(chatBox){
    chatBox.scrollTop = chatBox.scrollHeight;
}

const fetchUrl = "{{ route('support.messages',$ticket) }}";

let lastReplyId = {{ $replies->last()?->id ?? 0 }};

function pollMessages(){

    console.log("Polling...");

    fetch(fetchUrl,{
        headers:{
            "X-Requested-With":"XMLHttpRequest"
        }
    })

    .then(response=>response.json())

    .then(data=>{

        console.log(data);

        data.replies.forEach(function(reply){

            if(reply.id<=lastReplyId){
                return;
            }

            lastReplyId=reply.id;

            chatBox.insertAdjacentHTML("beforeend",`

                <div class="bubble-row ${reply.is_admin ? 'from-admin' : 'from-me'}">

                    <div class="bubble-author">
                        ${reply.is_admin ? reply.author : 'Bạn'}
                    </div>

                    <div class="bubble">
                        ${reply.message}
                    </div>

                    ${
                        reply.image_url
                        ?
                        `<a href="${reply.image_url}" target="_blank">
                            <img src="${reply.image_url}" class="bubble-img">
                        </a>`
                        :
                        ``
                    }

                    <div class="bubble-time">
                        ${reply.time}
                    </div>

                </div>

            `);

        });

        chatBox.scrollTop = chatBox.scrollHeight;

    })

    .catch(error=>{

        console.log(error);

    });

}

pollMessages();

setInterval(pollMessages,2000);

</script>

@endsection
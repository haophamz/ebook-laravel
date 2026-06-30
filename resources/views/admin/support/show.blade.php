@extends('layouts.quanli')
@include('includes.alert')

@section('styles')
    @include('admin.partials.admin-ui')
    <style>
        /* ===========================================================
           NAMESPACE: tất cả selector bên dưới đều bắt đầu bằng .supp-
           để KHÔNG đụng / KHÔNG bị đè bởi CSS global của admin-ui
           hay layout quanli (đây là nguyên nhân chính gây vỡ UI cũ).
           =========================================================== */
        .supp-wrap, .supp-wrap * {
            box-sizing: border-box;
        }

        .supp-wrap {
            max-width: 600px;
            margin: 24px auto;
            font-family: 'Segoe UI', sans-serif;
            color: #222;
            padding: 0 16px;
        }

        .supp-back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #5a6885;
            text-decoration: none;
            margin-bottom: 12px;
        }
        .supp-back-link:hover { color: #27ae60; }

        /* ===== Header ticket ===== */
        .supp-header {
            background: #fff;
            border: 1px solid #e6e8eb;
            border-radius: 14px 14px 0 0;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .supp-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(120deg, #2ecc71, #16a085);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
            flex-shrink: 0;
        }

        .supp-header .supp-info { flex: 1; min-width: 0; }
        .supp-header .supp-info h2 {
            margin: 0 0 4px;
            font-size: 15.5px;
            color: #1d2129;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .supp-header .supp-meta {
            font-size: 12px;
            color: #8a93a3;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }

        .supp-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 11.5px;
            font-weight: 600;
            white-space: nowrap;
            line-height: 1.4;
        }
        .supp-badge-pending     { background: #fff4e0; color: #b9770e; }
        .supp-badge-processing  { background: #e3f2fd; color: #1976d2; }
        .supp-badge-resolved    { background: #e6f9ee; color: #1e8449; }
        .supp-badge-closed      { background: #f1f2f4; color: #6b7178; }

        .supp-badge-cat {
            background: #eef1f6;
            color: #5a6885;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 11.5px;
            line-height: 1.4;
        }

        /* ===== Khung chat ===== */
        .supp-box {
            background: #f7f8fa;
            border-left: 1px solid #e6e8eb;
            border-right: 1px solid #e6e8eb;
            padding: 20px;
            height: 480px;
            max-height: 70vh;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 4px;
            scroll-behavior: smooth;
        }

        .supp-row { display: flex; flex-direction: column; max-width: 75%; margin-bottom: 10px; }
        .supp-row.supp-admin { align-self: flex-end; align-items: flex-end; margin-left: auto; }
        .supp-row.supp-user  { align-self: flex-start; align-items: flex-start; margin-right: auto; }

        .supp-author { font-size: 11px; color: #9aa3ad; margin-bottom: 4px; padding: 0 4px; }

        .supp-bubble {
            padding: 10px 14px;
            border-radius: 16px;
            font-size: 13.5px;
            line-height: 1.5;
            white-space: pre-line;
            word-break: break-word;
            max-width: 100%;
        }
        .supp-user .supp-bubble {
            background: #fff;
            border: 1px solid #e6e8eb;
            color: #2c2c2c;
            border-bottom-left-radius: 4px;
        }
        .supp-admin .supp-bubble {
            background: linear-gradient(120deg, #2ecc71, #16a085);
            color: #fff;
            border-bottom-right-radius: 4px;
        }

        .supp-img {
            margin-top: 6px;
            max-width: 200px;
            border-radius: 12px;
            border: 1px solid #e6e8eb;
            display: block;
            cursor: zoom-in;
        }

        .supp-time { font-size: 10px; color: #b3b9c2; margin-top: 4px; padding: 0 4px; }

        /* ===== Form trả lời ===== */
        .supp-footer {
            background: #fff;
            border: 1px solid #e6e8eb;
            border-radius: 0 0 14px 14px;
            padding: 16px 20px;
        }
        .supp-footer textarea {
            width: 100%;
            min-height: 60px;
            resize: vertical;
            border: 1px solid #dfe2e6;
            border-radius: 10px;
            padding: 11px 13px;
            font-size: 13.5px;
            font-family: inherit;
            outline: none;
            transition: border-color .15s, box-shadow .15s;
            display: block;
        }
        .supp-footer textarea:focus { border-color: #27ae60; box-shadow: 0 0 0 3px rgba(39,174,96,0.12); }

        .supp-footer-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 10px;
            gap: 10px;
            flex-wrap: wrap;
        }

        .supp-file-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12.5px;
            color: #5a6885;
            cursor: pointer;
            border: 1px dashed #cfd4db;
            padding: 6px 11px;
            border-radius: 8px;
            transition: border-color .15s, color .15s;
        }
        .supp-file-label:hover { border-color: #27ae60; color: #1e8449; }
        .supp-file-label input { display: none; }
        .supp-file-name { font-size: 11.5px; color: #27ae60; }

        .supp-btn-send {
            background: linear-gradient(120deg, #2ecc71, #16a085);
            color: #fff;
            border: none;
            padding: 9px 22px;
            border-radius: 9px;
            font-weight: 600;
            font-size: 13.5px;
            cursor: pointer;
            transition: filter .15s;
            margin-left: auto;
        }
        .supp-btn-send:hover { filter: brightness(1.07); }

        .supp-closed-note {
            text-align: center;
            font-size: 13px;
            color: #9aa3ad;
            padding: 6px 0 2px;
        }

        /* scrollbar gọn cho khung chat */
        .supp-box::-webkit-scrollbar { width: 6px; }
        .supp-box::-webkit-scrollbar-thumb { background: #c7ccd4; border-radius: 999px; }
        .supp-box::-webkit-scrollbar-track { background: transparent; }
    </style>
@endsection

@section('content')

@php
    $statusLabels = [
        'pending'    => 'Chờ xử lý',
        'processing' => 'Đang xử lý',
        'resolved'   => 'Đã giải quyết',
        'closed'     => 'Đã đóng',
    ];
    $displayName = $ticket->user?->name ?? 'Khách';
    $initial = mb_strtoupper(mb_substr($displayName, 0, 1));
@endphp

<div class="supp-wrap">

    <a href="{{ route('admin.support.index') }}" class="supp-back-link">&larr; Quay lại danh sách yêu cầu</a>

    {{-- Header --}}
    <div class="supp-header">
        <div class="supp-avatar">{{ $initial }}</div>
        <div class="supp-info">
            <h2>#{{ $ticket->id }} — {{ $ticket->title }} · {{ $displayName }}</h2>
            <div class="supp-meta">
                <span class="supp-badge-cat">{{ ucfirst($ticket->category) }}</span>
                <span class="supp-badge supp-badge-{{ $ticket->status }}">{{ $statusLabels[$ticket->status] ?? 'Khác' }}</span>
                <span>Tạo lúc {{ $ticket->created_at->format('H:i d/m/Y') }}</span>
            </div>
        </div>
    </div>

    {{-- Khung chat --}}
    <div class="supp-box" id="chatBox" data-ticket-id="{{ $ticket->id }}">

        {{-- Mô tả gốc của khách --}}
        <div class="supp-row supp-user">
            <div class="supp-author">{{ $displayName }}</div>
            <div class="supp-bubble">{{ $ticket->description }}</div>
            @if ($ticket->image_path)
                <a href="{{ asset('storage/' . $ticket->image_path) }}" target="_blank">
                    <img src="{{ asset('storage/' . $ticket->image_path) }}" class="supp-img">
                </a>
            @endif
            <div class="supp-time">{{ $ticket->created_at->format('H:i d/m/Y') }}</div>
        </div>

        {{-- Các phản hồi --}}
        <div id="repliesContainer">
        @foreach ($replies as $reply)
            <div class="supp-row {{ $reply->is_admin ? 'supp-admin' : 'supp-user' }}" data-reply-id="{{ $reply->id }}">
                <div class="supp-author">
                    {{ $reply->is_admin ? ($reply->user->name ?? 'Đội ngũ hỗ trợ') : $displayName }}
                </div>
                <div class="supp-bubble">{{ $reply->message }}</div>
                @if ($reply->image)
                    <a href="{{ asset('storage/' . $reply->image) }}" target="_blank">
                        <img src="{{ asset('storage/' . $reply->image) }}" class="supp-img">
                    </a>
                @endif
                <div class="supp-time">{{ $reply->created_at->format('H:i d/m/Y') }}</div>
            </div>
        @endforeach
        </div>

    </div>

    {{-- Form trả lời --}}
    <div class="supp-footer">
        @if ($ticket->status == 'closed')
            <p class="supp-closed-note">Ticket này đã được đóng.</p>
        @else
            <form action="{{ route('admin.support.reply', $ticket) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <textarea name="message" placeholder="Nhập phản hồi..." required>{{ old('message') }}</textarea>
                @error('message') <div style="color:#e74c3c;font-size:12.5px;margin-top:6px;">{{ $message }}</div> @enderror

                <div class="supp-footer-row">
                    <label class="supp-file-label">
                        Đính kèm ảnh
                        <input type="file" name="image" accept="image/jpeg,image/png,image/webp" id="replyImage">
                    </label>
                    <span class="supp-file-name" id="replyImageName"></span>

                    <button type="submit" class="supp-btn-send">Gửi</button>
                </div>
            </form>
        @endif
    </div>
</div>

<script>
(function () {
    const replyImage = document.getElementById('replyImage');
    if (replyImage) {
        replyImage.addEventListener('change', function () {
            document.getElementById('replyImageName').textContent = this.files.length ? this.files[0].name : '';
        });
    }

    const chatBox = document.getElementById('chatBox');
    const repliesContainer = document.getElementById('repliesContainer');
    const ticketId = chatBox.dataset.ticketId;
    const fetchUrl = "{{ route('admin.support.messages', $ticket) }}";

    // Cuộn xuống cuối khung chat. force=true => luôn cuộn (dùng khi load trang / gửi tin của chính mình)
    function scrollToBottom(force) {
        if (force || isNearBottom()) {
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    }

    function isNearBottom() {
        return chatBox.scrollHeight - chatBox.scrollTop - chatBox.clientHeight < 80;
    }

    // Cuộn xuống cuối NGAY khi DOM sẵn sàng...
    scrollToBottom(true);

    // ...và cuộn lại sau khi tất cả ảnh trong khung chat đã load xong,
    // vì ảnh load xong mới làm chatBox.scrollHeight tăng lên đúng giá trị thật.
    // (đây là nguyên nhân chính khiến trang KHÔNG tự cuộn xuống tin mới nhất)
    const images = chatBox.querySelectorAll('img');
    let pending = images.length;
    if (pending === 0) {
        scrollToBottom(true);
    } else {
        images.forEach(img => {
            if (img.complete) {
                pending--;
                if (pending === 0) scrollToBottom(true);
            } else {
                img.addEventListener('load', () => {
                    pending--;
                    if (pending === 0) scrollToBottom(true);
                });
                img.addEventListener('error', () => {
                    pending--;
                    if (pending === 0) scrollToBottom(true);
                });
            }
        });
    }
    // fallback cuối cùng phòng khi ảnh load chậm hơn dự kiến
    window.addEventListener('load', () => scrollToBottom(true));

    function buildBubble(reply) {
        const row = document.createElement('div');
        row.className = 'supp-row ' + (reply.is_admin ? 'supp-admin' : 'supp-user');
        row.dataset.replyId = reply.id;

        const author = document.createElement('div');
        author.className = 'supp-author';
        author.textContent = reply.author;
        row.appendChild(author);

        const bubble = document.createElement('div');
        bubble.className = 'supp-bubble';
        bubble.textContent = reply.message;
        row.appendChild(bubble);

        if (reply.image_url) {
            const link = document.createElement('a');
            link.href = reply.image_url;
            link.target = '_blank';
            const img = document.createElement('img');
            img.src = reply.image_url;
            img.className = 'supp-img';
            // khi ảnh mới load xong, nếu user đang ở cuối thì tự cuộn theo
            img.addEventListener('load', () => scrollToBottom(false));
            link.appendChild(img);
            row.appendChild(link);
        }

        const time = document.createElement('div');
        time.className = 'supp-time';
        time.textContent = reply.time;
        row.appendChild(time);

        return row;
    }

    function pollMessages() {
        if (!ticketId) return;

        fetch(fetchUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(res => res.ok ? res.json() : Promise.reject(res))
            .then(data => {
                const wasNearBottom = isNearBottom();

                const existingIds = new Set(
                    Array.from(repliesContainer.querySelectorAll('[data-reply-id]'))
                        .map(el => el.dataset.replyId)
                );

                let hasNew = false;
                (data.replies || []).forEach(reply => {
                    if (!existingIds.has(String(reply.id))) {
                        repliesContainer.appendChild(buildBubble(reply));
                        hasNew = true;
                    }
                });

                if (hasNew && wasNearBottom) {
                    // cuộn ngay (chưa cần đợi ảnh, ảnh load xong sẽ tự cuộn tiếp ở trên)
                    scrollToBottom(true);
                }
            })
            .catch(() => { /* bỏ qua lỗi mạng tạm thời, sẽ thử lại ở lần poll sau */ });
    }

    setInterval(pollMessages, 2000);
})();
</script>
@endsection
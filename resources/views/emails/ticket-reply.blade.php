<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Ticket đã có phản hồi</title>
</head>
<body style="margin:0; padding:0; background:#f3f4f6; font-family:Arial, sans-serif; color:#111827;">

<div style="max-width:620px; margin:30px auto; background:#ffffff; border-radius:14px; overflow:hidden; border:1px solid #e5e7eb;">

    <div style="background:#18c29c; padding:22px 26px; color:#ffffff;">
        <h2 style="margin:0; font-size:22px;">
            Ticket của bạn đã có phản hồi
        </h2>
    </div>

    <div style="padding:26px;">

        <p>Xin chào,</p>

        <p>
            Yêu cầu hỗ trợ của bạn đã được bộ phận hỗ trợ phản hồi.
        </p>

        <p>
            <strong>Mã Ticket:</strong> #{{ $ticket->id }}<br>
            <strong>Tiêu đề:</strong> {{ $ticket->title }}
        </p>

        <p>
            Vui lòng nhấn nút bên dưới để xem chi tiết và tiếp tục trao đổi.
        </p>

        <p style="margin:28px 0;">
            <a href="{{ route('support.show', $ticket->id) }}"
               style="display:inline-block; background:#18c29c; color:#ffffff; padding:12px 20px; border-radius:8px; text-decoration:none; font-weight:bold;">
                Xem Ticket
            </a>
        </p>

        <p style="color:#6b7280; font-size:14px;">
            Nếu bạn không gửi yêu cầu này, vui lòng bỏ qua email.
        </p>

    </div>

</div>

</body>
</html>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Ticket đã được đóng</title>
</head>
<body style="margin:0; padding:0; background:#f3f4f6; font-family:Arial, sans-serif; color:#111827;">

<div style="max-width:620px; margin:30px auto; background:#ffffff; border-radius:14px; overflow:hidden; border:1px solid #e5e7eb;">

    <div style="background:#111827; padding:22px 26px; color:#ffffff;">
        <h2 style="margin:0; font-size:22px;">
            Ticket của bạn đã được đóng
        </h2>
    </div>

    <div style="padding:26px;">

        <p>Xin chào,</p>

        <p>
            Ticket hỗ trợ của bạn đã được tự động đóng vì không có phản hồi mới trong vòng 24 giờ.
        </p>

        <p>
            <strong>Mã Ticket:</strong> #{{ $ticket->id }}<br>
            <strong>Tiêu đề:</strong> {{ $ticket->title }}
        </p>

        <p>
            Nếu bạn vẫn cần hỗ trợ, vui lòng tạo ticket mới.
        </p>

        <p style="margin:28px 0;">
            <a href="{{ route('support.index') }}"
               style="display:inline-block; background:#18c29c; color:#ffffff; padding:12px 20px; border-radius:8px; text-decoration:none; font-weight:bold;">
                Xem hỗ trợ
            </a>
        </p>

        <p style="color:#6b7280; font-size:14px;">
            EcoBook Support
        </p>

    </div>

</div>

</body>
</html>
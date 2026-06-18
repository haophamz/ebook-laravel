<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác thực Email</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #f0f4ff 0%, #e0e7ff 100%);
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        .card {
            width: 100%;
            max-width: 480px;
            background: #ffffff;
            border-radius: 24px;
            padding: 48px 40px;
            box-shadow: 0 20px 60px rgba(79, 70, 229, 0.12);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(to right, #4f46e5, #6366f1);
        }

        .icon-container {
            width: 96px;
            height: 96px;
            background: linear-gradient(135deg, #e0e7ff, #c7d2fe);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.2);
        }

        .icon-container i {
            font-size: 48px;
            color: #4f46e5;
        }

        h1 {
            font-size: 32px;
            font-weight: 700;
            color: #1e2937;
            margin-bottom: 16px;
        }

        p {
            color: #64748b;
            line-height: 1.7;
            font-size: 16px;
            margin-bottom: 32px;
        }

        .btn {
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            color: #fff;
            border: none;
            padding: 14px 32px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(79, 70, 229, 0.3);
            opacity: 1;
        }

        .btn:active {
            transform: scale(0.98);
        }

        .email-box {
            background: #f8fafc;
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            padding: 16px;
            margin: 20px 0;
            font-size: 15px;
            color: #475569;
        }

        .footer-text {
            margin-top: 32px;
            font-size: 14px;
            color: #94a3b8;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="icon-container">
        <i class="fa-solid fa-envelope-open-text"></i>
    </div>

    <h1>Xác thực Email của bạn</h1>

    <p>
        Chúng tôi đã gửi một email xác thực đến địa chỉ email của bạn.<br>
        Vui lòng kiểm tra <strong>Gmail</strong> và nhấn vào liên kết xác thực để kích hoạt tài khoản.
    </p>

    <div class="email-box">
        <i class="fa-solid fa-envelope" style="margin-right: 8px; color: #64748b;"></i>
        Kiểm tra hộp thư đến (và thư rác)
    </div>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf

        <button type="submit" class="btn">
            <i class="fa-solid fa-paper-plane"></i>
            Gửi lại email xác thực
        </button>
    </form>

    <div class="footer-text">
        Không nhận được email? Kiểm tra thư mục Spam hoặc thử gửi lại.
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: "toast-top-right",
        timeOut: 4500,
        extendedTimeOut: 1000,
        newestOnTop: true
    };
</script>

@if(session('success'))
    <script>
        toastr.success({{ json_encode(session('success')) }});
    </script>
@endif

@if(session('status'))
    <script>
        toastr.success('Email xác thực đã được gửi lại thành công!');
    </script>
@endif

@auth
    <script>
        let redirected = false;

        setInterval(() => {
            fetch('{{ url("/check-verified") }}')
                .then(response => response.json())
                .then(data => {
                    if (data.verified && !redirected) {
                        redirected = true;
                        toastr.success('✅ Email đã được xác thực thành công!', '', {
                            timeOut: 2000
                        });

                        setTimeout(() => {
                            window.location.href = "{{ route('home') }}";
                        }, 1800);
                    }
                })
                .catch(error => {
                    console.error('Lỗi kiểm tra xác thực:', error);
                });
        }, 3000);
    </script>
@endauth

</body>
</html>
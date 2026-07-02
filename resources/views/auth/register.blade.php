@include('includes.header')

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.10.0/dist/tabler-icons.min.css">

    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
</head>

<body>

    {{-- Background blobs --}}
    <div class="blob b1"></div>
    <div class="blob b2"></div>
    <div class="blob b3"></div>
    <div class="blob b4"></div>

    <div class="card">

        <h1>Tạo tài khoản ECOBOOK</h1>

        <p class="subtitle">
            Đăng ký miễn phí để khám phá hàng nghìn Ebook chất lượng.
        </p>

        <form method="POST" action="{{ route('register.store') }}">
            @csrf

            {{-- Email --}}
            <div class="field">
                <label>Email</label>

                <div class="input-wrap">
                    <i class="ti ti-mail"></i>

                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="Ví dụ: example@gmail.com">
                </div>
            </div>

            {{-- Password --}}
            <div class="field">
                <label>Mật khẩu</label>

                <div class="input-wrap">
                    <i class="ti ti-lock"></i>

                    <input type="password"
                           name="password"
                           placeholder="Nhập mật khẩu">
                </div>
            </div>

            {{-- First name --}}
            <div class="field">
                <label>Họ</label>

                <div class="input-wrap">
                    <i class="ti ti-user"></i>

                    <input type="text"
                           name="first_name"
                           value="{{ old('first_name') }}"
                           placeholder="Ví dụ: Nguyễn">
                </div>
            </div>

            {{-- Last name --}}
            <div class="field">
                <label>Tên</label>

                <div class="input-wrap">
                    <i class="ti ti-user"></i>

                    <input type="text"
                           name="last_name"
                           value="{{ old('last_name') }}"
                           placeholder="Ví dụ: Văn A">
                </div>
            </div>

            {{-- Terms --}}
            <div class="tos">

                <input type="checkbox"
                       id="tos"
                       name="tos">

                <span>

                    <label for="tos">
                        Tôi đồng ý với
                    </label>

                    <a href="#">
                        Điều khoản sử dụng
                    </a>

                    và

                    <a href="#">
                        Chính sách bảo mật
                    </a>

                </span>

            </div>

            {{-- Submit --}}
            <button class="btn-primary" type="submit">
                Đăng ký tài khoản
            </button>

            <div class="divider">
                hoặc
            </div>

            {{-- Google --}}
            <a href="{{ route('google.login') }}" class="btn-google">

                <svg viewBox="0 0 18 18" fill="none">
                    <path d="M17.64 9.2c0-.637-.057-1.251-.164-1.84H9v3.481h4.844a4.14 4.14 0 0 1-1.796 2.716v2.259h2.908c1.702-1.567 2.684-3.875 2.684-6.615Z" fill="#4285F4"/>
                    <path d="M9 18c2.43 0 4.467-.806 5.956-2.18l-2.908-2.259c-.806.54-1.837.86-3.048.86-2.344 0-4.328-1.584-5.036-3.711H.957v2.332A8.997 8.997 0 0 0 9 18Z" fill="#34A853"/>
                    <path d="M3.964 10.71A5.41 5.41 0 0 1 3.682 9c0-.593.102-1.17.282-1.71V4.958H.957A8.996 8.996 0 0 0 0 9c0 1.452.348 2.827.957 4.042l3.007-2.332Z" fill="#FBBC05"/>
                    <path d="M9 3.58c1.321 0 2.508.454 3.44 1.345l2.582-2.58C13.463.891 11.426 0 9 0A8.997 8.997 0 0 0 .957 4.958L3.964 7.29C4.672 5.163 6.656 3.58 9 3.58Z" fill="#EA4335"/>
                </svg>

                Đăng ký với Google

            </a>

            <p class="footer">

                Đã có tài khoản?

                <a href="{{ route('login') }}">
                    Đăng nhập ngay
                </a>

            </p>

        </form>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        @if(session('success'))
            toastr.success(@json(session('success')));
        @endif

        @if($errors->any())
            @foreach($errors->all() as $error)
                toastr.error(@json($error));
            @endforeach
        @endif

    });
    </script>

    <script src="{{ asset('js/signup.js') }}"></script>

</body>
</html>
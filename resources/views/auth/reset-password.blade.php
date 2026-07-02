@include('includes.header')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.10.0/dist/tabler-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
</head>
<body>

<div class="blob b1"></div>
<div class="blob b2"></div>
<div class="blob b3"></div>
<div class="blob b4"></div>

<div class="card">

    <h1>Create New Password</h1>

    <p class="subtitle">
        Enter your new password below.
    </p>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input
            type="hidden"
            name="token"
            value="{{ $token }}"
        >

        <div class="field">
            <label>Your email</label>

            <div class="input-wrap">
                <i class="ti ti-mail"></i>

                <input
                    type="email"
                    name="email"
                    value="{{ request()->email }}"
                    placeholder="e.g. elon@tesla.com"
                    required
                >
            </div>
        </div>

        <div class="field">
            <label>New Password</label>

            <div class="input-wrap">
                <i class="ti ti-lock"></i>

                <input
                    type="password"
                    name="password"
                    placeholder="Enter new password"
                    required
                >
            </div>
        </div>

        <div class="field">
            <label>Confirm Password</label>

            <div class="input-wrap">
                <i class="ti ti-lock-check"></i>

                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirm new password"
                    required
                >
            </div>
        </div>

        <button class="btn-primary" type="submit">
            Reset Password
        </button>

        <p class="footer">
            Back to
            <a href="{{ route('login') }}">
                Sign in
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

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error(@json($error));
        @endforeach
    @endif

});
</script>

</body>
</html>

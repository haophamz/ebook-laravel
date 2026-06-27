@extends('layouts.app')

@section('content')

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<style>

body{
    background:#121214;
}
.vip-badge{
    margin-top:15px;
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:8px 14px;
    border-radius:999px;
    background:#18c29c;
    color:#fff;
    font-size:13px;
    font-weight:600;
}

.free-badge{
    margin-top:15px;
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:8px 14px;
    border-radius:999px;
    background:#2a2a2e;
    color:#bbb;
    font-size:13px;
    font-weight:600;
}

.vip-expire{
    margin-top:10px;
    color:#9ca3af;
    font-size:13px;
    line-height:1.6;
}

.vip-expire strong{
    color:#18c29c;
}
.account-page{
    width:100%;
    margin-top:90px;
    padding:30px;
}
.account-layout{
    display:grid;
    grid-template-columns:260px 1fr;
    gap:35px;
}

/* SIDEBAR */

.account-sidebar{
    border-right:1px solid #242428;
    padding-right:25px;
}

.profile-box{
    padding-bottom:25px;
    margin-bottom:25px;
    border-bottom:1px solid #242428;
}

.profile-box img{
    width:78px;
    height:78px;
    border-radius:50%;
    border:3px solid #18c29c;
}

.profile-box h3{
    color:#fff;
    margin-top:15px;
}

.profile-box p{
    color:#888;
    font-size:14px;
}

.account-menu{
    display:flex;
    flex-direction:column;
    gap:6px;
}

.account-menu a{
    position:relative;
    display:flex;
    align-items:center;
    gap:14px;
    padding:14px 16px;
    border-radius:12px;
    text-decoration:none;
    color:#cfcfd4;
    transition:.25s;
}

.account-menu a:hover{
    background:#1a1a1d;
}

.account-menu a.active{
    background:#1a1a1d;
    color:#18c29c;
    font-weight:600;
}

.account-menu a.active::before{
    content:'';
    position:absolute;
    left:0;
    top:8px;
    bottom:8px;
    width:3px;
    border-radius:20px;
    background:#18c29c;
}

.account-menu i{
    width:24px;
    font-size:22px;
}

/* CONTENT */

.account-content{
    padding-right:20px;
}

.page-title{
    color:#fff;
    font-size:40px;
    margin-bottom:25px;
}

.account-tabs{
    display:flex;
    gap:30px;
    border-bottom:1px solid #242428;
    margin-bottom:30px;
}

.account-tabs a{
    text-decoration:none;
    color:#888;
    padding-bottom:15px;
}

.account-tabs a.active{
    color:#18c29c;
    border-bottom:2px solid #18c29c;
}

.form-layout{
    display:grid;
    grid-template-columns:1fr 240px;
    gap:60px;
}

.form-group{
    margin-bottom:18px;
}

.form-group label{
    display:block;
    color:#888;
    margin-bottom:8px;
}

.form-control{
    width:100%;
    height:56px;
    background:#1c1c1f;
    border:1px solid #2b2b31;
    border-radius:12px;
    color:#fff;
    padding:0 16px;
}

.form-control:focus{
    outline:none;
    border-color:#18c29c;
}

.avatar-box{
    text-align:center;
}

.avatar-box img{
    width:120px;
    height:120px;
    border-radius:50%;
    border:3px solid #18c29c;
}

.button-group{
    display:flex;
    gap:12px;
    margin-top:25px;
}

.btn{
    height:48px;
    padding:0 24px;
    border:none;
    border-radius:30px;
    cursor:pointer;
}

.btn-primary{
    background:#18c29c;
    color:#fff;
}

.btn-secondary{
    background:#242428;
    color:#fff;
}

@media(max-width:992px){

    .account-layout{
        grid-template-columns:1fr;
    }

    .account-sidebar{
        border-right:none;
        border-bottom:1px solid #242428;
        padding-bottom:25px;
    }

    .form-layout{
        grid-template-columns:1fr;
    }

}

</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>

toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "timeOut": "3000"
};

</script>

@if(session('success'))
<script>
toastr.success("{{ session('success') }}");
</script>
@endif

@if(session('error'))
<script>
toastr.error("{{ session('error') }}");
</script>
@endif

@if(session('warning'))
<script>
toastr.warning("{{ session('warning') }}");
</script>
@endif

@if(session('info'))
<script>
toastr.info("{{ session('info') }}");
</script>
@endif
<div class="account-page">

    <div class="account-layout">

        <aside class="account-sidebar">

<div class="profile-box">

    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=18c29c&color=fff">

    <h3>{{ Auth::user()->name }}</h3>

    <p>{{ Auth::user()->email }}</p>

    @if(Auth::user()->isVip())

        <div class="vip-badge">
            <i class="ti ti-crown"></i>
            Hội viên VIP
        </div>

        <div class="vip-expire">
            Hết hạn:
            <strong>
                {{ Auth::user()->vip_expires_at->format('d/m/Y H:i') }}
            </strong>
        </div>

    @else

        <div class="free-badge">
            <i class="ti ti-user"></i>
            Tài khoản miễn phí
        </div>

    @endif

</div>

            <nav class="account-menu">

    <a href="{{ route('account.profile') }}"
       class="{{ request()->routeIs('account.profile') ? 'active' : '' }}">

        <i class="ti ti-user-circle"></i>
        <span>Quản lý tài khoản</span>

    </a>

    <a href="{{ route('account.favorites') }}"
       class="{{ request()->routeIs('account.favorites') ? 'active' : '' }}">

        <i class="ti ti-heart"></i>
        <span>Sách yêu thích</span>

    </a>

    <a href="{{ route('account.history') }}"
       class="{{ request()->routeIs('account.history') ? 'active' : '' }}">

        <i class="ti ti-history"></i>
        <span>Lịch sử đọc</span>

    </a>

    <a href="{{ route('account.password') }}"
       class="{{ request()->routeIs('account.password') ? 'active' : '' }}">

        <i class="ti ti-lock"></i>
        <span>Đổi mật khẩu</span>

    </a>

</nav>

</aside>

<main class="account-content">

    @yield('account-content')

</main>

</div>

</div>

@endsection
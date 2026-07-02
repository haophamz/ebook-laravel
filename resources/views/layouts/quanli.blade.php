<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Admin') | OCR Manager</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
.sidebar-logo{
    display:flex;
    align-items:center;
    gap:14px;
    padding:6px 0;
}

.sidebar-logo-mark{
    width:46px;
    height:46px;
    border-radius:14px;
    background:linear-gradient(135deg,#18c29c,#16a34a);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:24px;
    font-weight:900;
    color:#fff;
    box-shadow:0 10px 24px rgba(24,194,156,.35);
    flex-shrink:0;
}

.sidebar-logo-text{
    display:flex;
    flex-direction:column;
    line-height:1;
}

.sidebar-logo-text span{
    font-size:20px;
    font-weight:900;
    color:#18c29c;
    letter-spacing:.8px;
}

.sidebar-logo-text small{
    margin-top:4px;
    font-size:11px;
    font-weight:700;
    letter-spacing:4px;
    color:#7ee7c9;
    text-transform:uppercase;
}
:root{
    --bg:#ffffff;
    --bg-soft:#fafafa;
    --surface:#ffffff;
    --border:#eef0f3;
    --text:#16181d;
    --text-soft:#8a8f98;
--accent:#18c29c;
    --accent-soft:rgba(24,194,156,.14);
    --good:#10b981;
    --radius:18px;
    --shadow:0 1px 2px rgba(16,24,40,0.04);
}
.page-head h1{
    color:#18c29c !important;
}
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Inter',sans-serif;
}

body{
    background:var(--bg-soft);
    color:var(--text);
}

.layout{
    display:flex;
    min-height:100vh;
}
.status{
    display:inline-flex;
    align-items:center;
    justify-content:center;

    min-width:90px;
    height:34px;

    border-radius:999px;

    font-size:13px;
    font-weight:600;
}

.status.active{
    background:#ecfdf5;
    color:#059669;
}

.status.inactive{
    background:#fef2f2;
    color:#dc2626;
}

/* ============================= */
/* SIDEBAR                        */
/* ============================= */
.sidebar{
    width:264px;
    background:var(--surface);
    border-right:1px solid var(--border);
    display:flex;
    flex-direction:column;
    flex-shrink:0;
}

.sidebar-logo{
    height:76px;
    padding:0 28px;
    display:flex;
    align-items:center;
    gap:12px;
}



.sidebar-logo-text{
    font-size:15px;
    font-weight:700;
    letter-spacing:-0.2px;
    color:var(--text);
}

.sidebar-section-title{
    padding:22px 28px 10px;
    font-size:11px;
    letter-spacing:1px;
    color:var(--text-soft);
    font-weight:600;
    text-transform:uppercase;
}

.sidebar-menu{
    list-style:none;
}

.sidebar-menu li{
    padding:0 16px;
    margin-bottom:2px;
}

.sidebar-menu a{
    display:flex;
    align-items:center;
    gap:13px;
    padding:11px 14px;
    text-decoration:none;
    color:var(--text-soft);
    border-radius:11px;
    font-size:14px;
    font-weight:500;
    transition:all 0.15s ease;
}

.sidebar-menu a i{
    font-size:18px;
}

.sidebar-menu a.active{
    background:var(--accent-soft);
    color:var(--accent);
    font-weight:600;
}

.sidebar-menu a:hover:not(.active){
    background:var(--bg-soft);
    color:var(--text);
}

.sidebar-footer{
    margin-top:auto;
    padding:18px;
    border-top:1px solid var(--border);
}

.sidebar-footer-card{
    background:var(--bg-soft);
    border-radius:14px;
    padding:16px;
    text-align:left;
}

.sidebar-footer-card p{
    font-size:12.5px;
    color:var(--text-soft);
    line-height:1.5;
    margin-bottom:10px;
}

.sidebar-footer-card button{
    width:100%;
    border:none;
    background:var(--text);
    color:#fff;
    font-size:13px;
    font-weight:600;
    padding:9px 0;
    border-radius:9px;
    cursor:pointer;
}

/* ============================= */
/* MAIN                            */
/* ============================= */
.main{
    flex:1;
    min-width:0;
}

.topbar{
    height:76px;
    background:var(--surface);
    border-bottom:1px solid var(--border);
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 36px;
    position:sticky;
    top:0;
    z-index:10;
}

.search-wrap{
    position:relative;
    width:420px;
}

.search-wrap i{
    position:absolute;
    left:16px;
    top:50%;
    transform:translateY(-50%);
    color:var(--text-soft);
    font-size:17px;
}

.search{
    width:100%;
    height:42px;
    border:1px solid var(--border);
    background:var(--bg-soft);
    border-radius:11px;
    padding:0 16px 0 42px;
    outline:none;
    font-size:14px;
    color:var(--text);
    transition:all 0.15s ease;
}

.search::placeholder{ color:var(--text-soft); }

.search:focus{
    border-color:var(--accent);
    background:#fff;
    box-shadow:0 0 0 3px var(--accent-soft);
}

.right{
    display:flex;
    align-items:center;
    gap:20px;
}

.icon-btn{
    width:40px;
    height:40px;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    color:var(--text-soft);
    font-size:19px;
    cursor:pointer;
    position:relative;
    transition:background 0.15s ease;
}

.icon-btn:hover{ background:var(--bg-soft); }

.icon-btn .dot{
    position:absolute;
    top:8px;
    right:9px;
    width:7px;
    height:7px;
    border-radius:50%;
    background:#ef4444;
    border:2px solid var(--surface);
}

.user{
    display:flex;
    align-items:center;
    gap:10px;
    font-weight:600;
    font-size:14px;
    padding-left:16px;
    border-left:1px solid var(--border);
}

.avatar{
    width:38px;
    height:38px;
    border-radius:50%;
    background:linear-gradient(135deg,#6366f1,#4338ca);
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:16px;
    color:#fff;
    font-weight:700;
}

/* CONTENT */
.content{
    padding:36px;
}
.admin-user{
    position:relative;
}

.admin-dropdown{
    position:absolute;
    top:calc(100% + 12px);
    right:0;
    width:220px;
    background:#fff;
    border:1px solid #e8e8e8;
    border-radius:14px;
    box-shadow:0 20px 45px rgba(0,0,0,.12);
    overflow:hidden;

    opacity:0;
    visibility:hidden;
    transform:translateY(10px);
    transition:.25s;
    z-index:9999;
}

.admin-user:hover .admin-dropdown{
    opacity:1;
    visibility:visible;
    transform:none;
}

.admin-dropdown a,
.admin-dropdown button{
    width:100%;
    display:flex;
    align-items:center;
    gap:10px;
    padding:14px 18px;
    text-decoration:none;
    border:none;
    background:none;
    color:#444;
    cursor:pointer;
    font-size:14px;
    transition:.2s;
}

.admin-dropdown a:hover,
.admin-dropdown button:hover{
    background:rgba(24,194,156,.08);
    color:#18c29c;
}

.dropdown-line{
    height:1px;
    background:#ececec;
}

.user{
    display:flex;
    align-items:center;
    gap:10px;
    cursor:pointer;
}
@yield('styles')
</style>

</head>

<body>


<div class="layout">

    @include('includes.sidebar')

  <main class="main">

    <div class="topbar">

        <div class="search-wrap">

        </div>

        <div class="right">

            <div class="icon-btn">

           
            </div>

            <div class="icon-btn">
    
            </div>

            <div class="admin-user">

                <div class="user">

                    <div class="avatar">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A',0,1)) }}
                    </div>

                    <span>
                        {{ auth()->user()->name ?? 'Admin' }}
                    </span>

                    <i class="ti ti-chevron-down"></i>

                </div>

                <div class="admin-dropdown">

                    <a href="/">
                        <i class="ti ti-home"></i>
                        <span>Trang chủ</span>
                    </a>

                    <div class="dropdown-line"></div>

                    <form method="POST"
                          action="{{ route('logout') }}">
                        @csrf

                        <button type="submit">
                            <i class="ti ti-logout"></i>
                            <span>Đăng xuất</span>
                        </button>
                    </form>

                </div>

            </div>

        </div>

    </div>
        <div class="content">
            @yield('content')
        </div>
    </main>
</div>

@yield('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
toastr.options = {
    closeButton:true,
    progressBar:true,
    positionClass:"toast-top-right"
};

@if(session('success'))
toastr.success(@json(session('success')));
@endif

@if(session('error'))
toastr.error(@json(session('error')));
@endif

@if($errors->any())
toastr.error(@json($errors->first()));
@endif
</script>

</body>
</html>
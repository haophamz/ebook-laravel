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

:root{
    --bg:#ffffff;
    --bg-soft:#fafafa;
    --surface:#ffffff;
    --border:#eef0f3;
    --text:#16181d;
    --text-soft:#8a8f98;
    --accent:#4f46e5;
    --accent-soft:#eef0ff;
    --good:#10b981;
    --radius:18px;
    --shadow:0 1px 2px rgba(16,24,40,0.04);
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

.sidebar-logo-mark{
    width:34px;
    height:34px;
    border-radius:10px;
    background:linear-gradient(135deg, #6366f1, #4338ca);
    color:#fff;
    display:flex;
    justify-content:center;
    align-items:center;
    font-weight:700;
    font-size:16px;
    box-shadow:0 4px 10px rgba(79,70,229,0.25);
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

@yield('styles')
</style>

</head>

<body>


<div class="layout">

    @include('includes.sidebar')

    <main class="main">
        <div class="topbar">
            <div class="search-wrap">
                <i class="ti ti-search"></i>
                <input class="search" placeholder="Tìm kiếm tài liệu...">
            </div>
            <div class="right">
                <div class="icon-btn"><i class="ti ti-bell"></i><span class="dot"></span></div>
                <div class="icon-btn"><i class="ti ti-settings"></i></div>
                <div class="user">
                    <div class="avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
                    <span>{{ auth()->user()->name ?? 'Admin' }}</span>
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
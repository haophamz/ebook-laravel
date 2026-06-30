<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

<style>
    .search-form{
    width:160px;
}
.search-form{
    display:flex;
    align-items:center;
    width:220px;
    max-width:220px;
    height:45px;
    background:#1e1e1e;
    border:1px solid #2b2b2b;
    border-radius:999px;
    overflow:hidden;
    flex-shrink:1;
}

.search-form input{
    flex:1;
    min-width:0;
    height:100%;
    padding:0 14px;
    border:none;
    outline:none;
    background:transparent;
    color:#fff;
    font-size:14px;
}

.search-form input::placeholder{
    color:#777;
}

.search-form button{
    width:44px;
    height:100%;
    border:none;
    background:transparent;
    color:#bbb;
    cursor:pointer;
    transition:.2s;
}

.search-form button:hover{
    color:#18c29c;
}
.menu{
    display:flex;
    gap:30px;
    align-items:center;
}

.menu-item{
    position:relative;
}

.menu-item>a{
    color:#ddd;
    text-decoration:none;
    font-weight:500;
    transition:.3s;
}

.menu-item>a:hover{
    color:#18c29c;
}

.menu-dropdown{
    position:absolute;
    top:100%;
    left:0;
    min-width:240px;
    background:#181818;
    border:1px solid #2b2b2b;
    border-radius:12px;
    padding:10px 0;
    margin-top:16px;
    opacity:0;
    visibility:hidden;
    transform:translateY(10px);
    transition:.25s;
    z-index:9999;
    box-shadow:0 20px 40px rgba(0,0,0,.45);
}

.menu-item:hover .menu-dropdown{
    opacity:1;
    visibility:visible;
    transform:none;
}

.menu-dropdown a{
    display:flex;
    align-items:center;
    gap:10px;
    padding:12px 18px;
    color:#ddd;
    text-decoration:none;
    transition:.2s;
}

.menu-dropdown a:hover{
    background:#252525;
    color:#18c29c;
}
.header{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    z-index:9999;
    background:#111;
    border-bottom:1px solid #222;
}

.header-container{
    max-width:1400px;
    margin:auto;
    padding:0 24px;
    height:76px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.left{
    display:flex;
    align-items:center;
    gap:45px;
}

.logo{
    text-decoration:none;
    font-size:34px;
    font-weight:800;
    color:#18c29c;
}

.menu{
    display:flex;
    gap:30px;
}

.menu a{
    color:#ddd;
    text-decoration:none;
    font-weight:500;
    transition:.3s;
}

.menu a:hover{
    color:#18c29c;
}

.right{
    display:flex;
    align-items:center;
    gap:12px;
}

.search{
    width:45px;
    height:45px;
    border:none;
    border-radius:50%;
    background:#1e1e1e;
    color:white;
    cursor:pointer;
    display:flex;
    align-items:center;
    justify-content:center;
    transition: .2s;
}

.search:hover {
    background: #252525;
    color: #18c29c;
}

/* CLASS ICON GIỎ HÀNG MỚI */
.cart-btn-wrap {
    position: relative;
    text-decoration: none;
}

.cart-trigger {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: #1e1e1e;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: .2s;
    font-size: 18px;
}

.cart-btn-wrap:hover .cart-trigger {
    background: #252525;
    color: #18c29c;
}

.cart-badge {
    position: absolute;
    top: -2px;
    right: -2px;
    background: #ef4444;
    color: white;
    font-size: 11px;
    font-weight: 700;
    min-width: 18px;
    height: 18px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 4px;
    border: 2px solid #111;
}

.package{
    height:45px;
    padding:0 18px;
    border-radius:25px;
    background:#222;
    color:white;
    text-decoration:none;
    display:flex;
    align-items:center;
    gap:8px;
    transition: .2s;
}

.package:hover {
    background: #2a2a2a;
    color: #18c29c;
}

.register{
    height:45px;
    padding:0 20px;
    border-radius:25px;
    background:#18c29c;
    color:white;
    text-decoration:none;
    display:flex;
    align-items:center;
    font-weight:600;
}

.login{
    height:45px;
    padding:0 20px;
    border-radius:25px;
    border:1px solid #333;
    color:white;
    text-decoration:none;
    display:flex;
    align-items:center;
}

.user-menu{
    position:relative;
}

.user-trigger{
    display:flex;
    align-items:center;
    gap:10px;
    padding:6px 12px;
    cursor:pointer;
}

.avatar{
    width:42px;
    height:42px;
    border-radius:50%;
    border:2px solid #18c29c;
}

.user-info{
    line-height:1.2;
}

.user-name{
    color:#fff;
    font-size:14px;
    font-weight:600;
}

.user-role{
    color:#18c29c;
    font-size:11px;
}

.dropdown{
    position:absolute;
    top:100%;
    right:0;
    width:320px;
    background:#181818;
    border:1px solid #2b2b2b;
    border-radius:16px;
    overflow:hidden;
    box-shadow:0 20px 50px rgba(0,0,0,.45);

    opacity:0;
    visibility:hidden;
    transform:translateY(10px);

    transition:.25s;
}

.user-menu:hover .dropdown{
    opacity:1;
    visibility:visible;
    transform:none;
}

.dropdown-top{
    padding:20px;
    display:flex;
    gap:15px;
    align-items:center;
}

.dropdown-top img{
    width:60px;
    height:60px;
    border-radius:50%;
}

.dropdown-top h4{
    color:#fff;
}

.dropdown-top p{
    margin-top:5px;
    color:#888;
    font-size:13px;
}

.line{
    height:1px;
    background:#2a2a2a;
}

.dropdown a,
.dropdown button{
    width:100%;
    border:none;
    background:none;
    color:#ddd;
    text-decoration:none;
    padding:15px 20px;
    display:flex;
    align-items:center;
    gap:12px;
    cursor:pointer;
    font-size:14px;
}

.dropdown a:hover,
.dropdown button:hover{
    background:#252525;
    color:#18c29c;
}

@media(max-width:900px){

    .menu{
        display:none;
    }

    .package{
        display:none;
    }

    .user-info{
        display:none;
    }

}

</style>

<header class="header">

<div class="header-container">

<div class="left">
    <a href="/" class="logo">
        ECOBOOK
    </a>

    <nav class="menu">
<a href="{{ route('books.free') }}">
   Miễn phí
</a>
<a href="{{ route('books.member') }}">Hội viên</a>        
<a href="{{ route('books.paid') }}">
    Mua lẻ
</a>
@php
    $categories = \App\Models\Category::where('status',1)
        ->orderBy('name')
        ->get();
@endphp

<div class="menu-item">
    <a href="#">
        Danh mục
        <i class="ti ti-chevron-down"></i>
    </a>

    <div class="menu-dropdown">
        @foreach($categories as $category)
            <a href="{{ route('category.show',$category->slug) }}">
                <i class="ti ti-book"></i>
                {{ $category->name }}
            </a>
        @endforeach
    </div>
</div>

<div class="right">
<form action="{{ route('books.search') }}" method="GET" class="search-form">
    <input
        type="text"
        name="q"
        placeholder="Tên sách hoặc tác giả..."
        value="{{ request('q') }}"
    >

    <button type="submit">
        <i class="ti ti-search"></i>
    </button>
</form>

    <a href="{{ route('cart.index') }}" class="cart-btn-wrap">
        <div class="cart-trigger">
            <i class="ti ti-shopping-cart"></i>
        </div>
        @auth
            @php
                $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count();
            @endphp
            @if($cartCount > 0)
                <span class="cart-badge">{{ $cartCount }}</span>
            @endif
        @endauth
    </a>

    <a href="{{ route('pricing') }}" class="package">
        <i class="ti ti-crown"></i>
        Gói cước
    </a>

    @guest
        <a href="{{ route('register') }}" class="register">Đăng ký</a>
        <a href="{{ route('login') }}" class="login">Đăng nhập</a>
    @endguest

    @auth
    <div class="user-menu">
        <div class="user-trigger">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=18c29c&color=fff" class="avatar">
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role">
                    {{ auth()->user()->fresh()->isVip() ? 'VIP MEMBER' : 'FREE MEMBER' }}
                </div>
            </div>
            <i class="ti ti-chevron-down"></i>
        </div>

        <div class="dropdown">
            <div class="dropdown-top">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=18c29c&color=fff">
                <div>
                    <h4>{{ Auth::user()->name }}</h4>
                    <p>{{ Auth::user()->email }}</p>
                </div>
            </div>

            <div class="line"></div>

            <a href="{{ route('account.profile') }}">
                <i class="ti ti-user"></i> Hồ sơ
            </a>

            <a href="{{ route('cart.index') }}">
                <i class="ti ti-shopping-cart"></i> Giỏ hàng của tôi
            </a>

            <a href="{{ route('account.favorites') }}">
                <i class="ti ti-heart"></i> Sách yêu thích
            </a>
            <a href="{{ route('support.index') }}">
    <i class="ti ti-headset"></i> Hỗ trợ
</a>

            <div class="line"></div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">
                    <i class="ti ti-logout"></i> Đăng xuất
                </button>
            </form>
        </div>
    </div>
    @endauth

</div>
</div>

</header>
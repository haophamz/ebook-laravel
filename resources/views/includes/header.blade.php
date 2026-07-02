<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

<style>
.eco-header{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    z-index:9999;
    background:#111;
    border-bottom:1px solid #222;
}

.eco-header-container{
    max-width:1400px;
    margin:auto;
    padding:0 24px;
    height:76px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.eco-header-left{
    display:flex;
    align-items:center;
    gap:45px;
}

.eco-logo{
    text-decoration:none;
    font-size:34px;
    font-weight:800;
    color:#18c29c;
}

.eco-menu{
    display:flex;
    gap:30px;
    align-items:center;
}

.eco-menu a{
    color:#ddd;
    text-decoration:none;
    font-weight:500;
    transition:.3s;
}

.eco-menu a:hover{
    color:#18c29c;
}

.eco-menu-item{
    position:relative;
}

.eco-menu-dropdown{
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

.eco-menu-item:hover .eco-menu-dropdown{
    opacity:1;
    visibility:visible;
    transform:none;
}

.eco-menu-dropdown a{
    display:flex;
    align-items:center;
    gap:10px;
    padding:12px 18px;
}

.eco-header-right{
    display:flex;
    align-items:center;
    gap:12px;
}

.eco-search-form{
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

.eco-search-form input{
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

.eco-search-form input::placeholder{
    color:#777;
}

.eco-search-form button{
    width:44px;
    height:100%;
    border:none;
    background:transparent;
    color:#bbb;
    cursor:pointer;
    transition:.2s;
}

.eco-search-form button:hover{
    color:#18c29c;
}

.eco-cart-wrap{
    position:relative;
    text-decoration:none;
}

.eco-cart-trigger{
    width:45px;
    height:45px;
    border-radius:50%;
    background:#1e1e1e;
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    transition:.2s;
    font-size:18px;
}

.eco-cart-wrap:hover .eco-cart-trigger{
    background:#252525;
    color:#18c29c;
}

.eco-cart-badge{
    position:absolute;
    top:-2px;
    right:-2px;
    background:#ef4444;
    color:white;
    font-size:11px;
    font-weight:700;
    min-width:18px;
    height:18px;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:0 4px;
    border:2px solid #111;
}

.eco-package-btn,
.eco-register-btn,
.eco-login-btn{
    height:45px;
    padding:0 20px;
    border-radius:25px;
    color:white;
    text-decoration:none;
    display:flex;
    align-items:center;
    gap:8px;
}

.eco-package-btn{
    background:#222;
}

.eco-package-btn:hover{
    background:#2a2a2a;
    color:#18c29c;
}

.eco-register-btn{
    background:#18c29c;
    font-weight:600;
}

.eco-login-btn{
    border:1px solid #333;
}

.eco-user-menu{
    position:relative;
}

.eco-user-trigger{
    display:flex;
    align-items:center;
    gap:10px;
    padding:6px 12px;
    cursor:pointer;
}

.eco-avatar{
    width:42px;
    height:42px;
    border-radius:50%;
    border:2px solid #18c29c;
}

.eco-user-info{
    line-height:1.2;
}

.eco-user-name{
    color:#fff;
    font-size:14px;
    font-weight:600;
}

.eco-user-role{
    color:#18c29c;
    font-size:11px;
}

.eco-user-dropdown{
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

.eco-user-menu:hover .eco-user-dropdown{
    opacity:1;
    visibility:visible;
    transform:none;
}

.eco-dropdown-top{
    padding:20px;
    display:flex;
    gap:15px;
    align-items:center;
}

.eco-dropdown-top img{
    width:60px;
    height:60px;
    border-radius:50%;
}

.eco-dropdown-top h4{
    color:#fff;
}

.eco-dropdown-top p{
    margin-top:5px;
    color:#888;
    font-size:13px;
}

.eco-divider{
    height:1px;
    background:#2a2a2a;
}

.eco-user-dropdown a,
.eco-user-dropdown button{
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

.eco-user-dropdown a:hover,
.eco-user-dropdown button:hover{
    background:#252525;
    color:#18c29c;
}

@media(max-width:900px){
    .eco-menu{
        display:none;
    }

    .eco-package-btn{
        display:none;
    }

    .eco-user-info{
        display:none;
    }
}
</style>

<header class="eco-header">

    <div class="eco-header-container">

        <div class="eco-header-left">

            <a href="/" class="eco-logo">
                ECOBOOK
            </a>

            <nav class="eco-menu">

                <a href="{{ route('books.free') }}">
                    Miễn phí
                </a>

                <a href="{{ route('books.member') }}">
                    Hội viên
                </a>

                <a href="{{ route('books.paid') }}">
                    Mua lẻ
                </a>

                @php
                    $categories = \App\Models\Category::where('status',1)
                        ->orderBy('name')
                        ->get();
                @endphp

                <div class="eco-menu-item">

                    <a href="#">
                        Danh mục
                        <i class="ti ti-chevron-down"></i>
                    </a>

                    <div class="eco-menu-dropdown">

                        @foreach($categories as $category)

                            <a href="{{ route('category.show',$category->slug) }}">
                                <i class="ti ti-book"></i>
                                {{ $category->name }}
                            </a>

                        @endforeach

                    </div>

                </div>

            </nav>

        </div>

        <div class="eco-header-right">

            <form action="{{ route('books.search') }}" method="GET" class="eco-search-form">

                <input
                    type="text"
                    name="q"
                    placeholder="Tên sách hoặc tác giả..."
                    value="{{ request('q') }}">

                <button type="submit">
                    <i class="ti ti-search"></i>
                </button>

            </form>

            <a href="{{ route('cart.index') }}" class="eco-cart-wrap">

                <div class="eco-cart-trigger">
                    <i class="ti ti-shopping-cart"></i>
                </div>

                @auth

                    @php
                        $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count();
                    @endphp

                    @if($cartCount > 0)

                        <span class="eco-cart-badge">
                            {{ $cartCount }}
                        </span>

                    @endif

                @endauth

            </a>

            <a href="{{ route('pricing') }}" class="eco-package-btn">
                <i class="ti ti-crown"></i>
                Gói cước
            </a>

            @guest

                <a href="{{ route('register') }}" class="eco-register-btn">
                    Đăng ký
                </a>

                <a href="{{ route('login') }}" class="eco-login-btn">
                    Đăng nhập
                </a>

            @endguest

            @auth

                <div class="eco-user-menu">

                    <div class="eco-user-trigger">

                        <img
                            src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=18c29c&color=fff"
                            class="eco-avatar">

                        <div class="eco-user-info">

                            <div class="eco-user-name">
                                {{ Auth::user()->name }}
                            </div>

<div class="eco-user-role">

    @if(auth()->user()->is_admin)

       ADMIN

    @elseif(auth()->user()->fresh()->isVip())

        VIP MEMBER

    @else

        FREE MEMBER

    @endif

</div>

                        </div>

                        <i class="ti ti-chevron-down"></i>

                    </div>

                    <div class="eco-user-dropdown">

                        <div class="eco-dropdown-top">

                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=18c29c&color=fff">

                            <div>
                                <h4>{{ Auth::user()->name }}</h4>
                                <p>{{ Auth::user()->email }}</p>
                            </div>

                        </div>

                        <div class="eco-divider"></div>
@if(auth()->user()->is_admin)
    <a href="{{ route('admin.revenue.index') }}">
        <i class="ti ti-layout-dashboard"></i>
        Trang quản trị
    </a>
@endif
                        <a href="{{ route('account.profile') }}">
                            <i class="ti ti-user"></i>
                            Hồ sơ
                        </a>

                        <a href="{{ route('cart.index') }}">
                            <i class="ti ti-shopping-cart"></i>
                            Giỏ hàng của tôi
                        </a>

                        <a href="{{ route('account.favorites') }}">
                            <i class="ti ti-heart"></i>
                            Sách yêu thích
                        </a>

                        <a href="{{ route('support.index') }}">
                            <i class="ti ti-headset"></i>
                            Hỗ trợ
                        </a>

                        <div class="eco-divider"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit">
                                <i class="ti ti-logout"></i>
                                Đăng xuất
                            </button>

                        </form>

                    </div>

                </div>

            @endauth

        </div>

    </div>

</header>
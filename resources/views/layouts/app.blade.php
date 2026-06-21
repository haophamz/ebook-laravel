<!DOCTYPE html>

<html lang="vi">

<head>

```
<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>@yield('title','HIKI')</title>

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Inter,Segoe UI,sans-serif;
}

body{
    background:#05080f;
    min-height:100vh;
}

a{
    text-decoration:none;
}



/* HEADER */

header{
    width:100%;
    height:78px;
    background:#080c14;
    border-bottom:1px solid rgba(255,255,255,.05);

    position:fixed;
    top:0;
    left:0;
    z-index:999;
}

.header-container{
    max-width:1700px;
    margin:auto;

    height:100%;

    padding:0 40px;

    display:flex;
    align-items:center;
    justify-content:space-between;
}

.left{
    display:flex;
    align-items:center;
    gap:50px;
}

.logo{
    font-size:34px;
    font-weight:900;
    color:#16d6a5;
    letter-spacing:1px;
}

.menu{
    display:flex;
    align-items:center;
    gap:28px;
}

.menu a{
    color:#fff;
    font-size:18px;
    font-weight:500;
    transition:.2s;
}

.menu a:hover{
    color:#16d6a5;
}

.right{
    display:flex;
    align-items:center;
    gap:15px;
}

.search{
    width:42px;
    height:42px;

    border:none;
    background:none;

    color:#fff;
    font-size:22px;

    cursor:pointer;
}

.package{
    color:#ffc83d;

    border:1px solid #ffc83d;

    border-radius:999px;

    padding:10px 18px;

    font-size:14px;
    font-weight:700;
}

.register{
    color:#fff;
    font-weight:600;
}

.login{
    background:#16d6a5;
    color:#fff;

    padding:12px 24px;

    border-radius:999px;

    font-weight:700;
}

/* BANNER */

.home-banner{
    width:100%;
    margin-bottom:50px;
}

.bannerSwiper{
    width:100%;
}

.bannerSwiper img{
    width:100%;
    height:520px;
    object-fit:cover;
    display:block;
}

.swiper-button-prev,
.swiper-button-next{
    color:#fff;
}

.swiper-pagination-bullet{
    background:#fff;
}

/* CONTENT */

.section{
    max-width:1700px;
    margin:auto;
    padding:0 40px;
    margin-bottom:50px;
}

.section-title{
    color:#fff;
    font-size:32px;
    font-weight:800;

    border-left:5px solid #16d6a5;
    padding-left:14px;

    margin-bottom:25px;
}

/* FOOTER */

footer{
    margin-top:80px;

    border-top:1px solid rgba(255,255,255,.06);

    padding:40px;

    color:#9ca3af;
}
.section{
    min-height:1000px;
}
</style>
```

</head>

<body>

```
@include('includes.header')

<main>

    @yield('content')

</main>

@include('includes.footer')
```

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function(){

    new Swiper('.bannerSwiper', {

        loop:true,

        autoplay:{
            delay:4000,
            disableOnInteraction:false,
        },

        pagination:{
            el:'.swiper-pagination',
            clickable:true,
        },

        navigation:{
            nextEl:'.swiper-button-next',
            prevEl:'.swiper-button-prev',
        }

    });

});

</script>

</body>
</html>

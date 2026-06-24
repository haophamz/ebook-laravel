<!DOCTYPE html>

<html lang="vi">

<head>
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
    background:#121214;
  
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
    width:95%;
    margin:auto;
    margin-bottom:60px;
}

.section-title{
    color:#fff;
    font-size:34px;
    font-weight:800;
    margin-bottom:30px;
}

.book-grid{
    display:grid;
    grid-template-columns:repeat(6,1fr);
    gap:24px;
}

.book-card{
    position:relative;
    transition:.25s;
}

.book-card:hover{
    transform:translateY(-6px);
}

.member-badge{
    position:absolute;
    top:-10px;
    right:-1px;
    z-index:30;
}

.member-badge img{
    width:130px;
    display:block;
}

.book-cover{
    position:relative;
    height:340px;
    border-radius:16px;
    overflow:hidden;
    background:#111827;
}

.book-cover img{
    width:100%;
    height:100%;
    object-fit:cover;
    display:block;
}

.book-overlay{
    position:absolute;
    inset:0;

    opacity:0;

    padding:18px;

    display:flex;
    flex-direction:column;
    justify-content:flex-end;

    background:
    linear-gradient(
        to top,
        rgba(0,0,0,.95),
        rgba(0,0,0,.15)
    );

    transition:.25s;
}

.book-card:hover .book-overlay{
    opacity:1;
}

.book-overlay h4{
    color:#fff;
    font-size:18px;
    font-weight:700;
    margin-bottom:10px;
}

.book-overlay p{
    color:#cbd5e1;
    font-size:13px;
    line-height:1.7;
    margin-bottom:16px;
}

.overlay-actions{
    display:flex;
    align-items:center;
}

.btn-read{
    display:inline-block;

    padding:10px 16px;

    background:#18d5a6;
    color:#fff;

    border-radius:10px;

    font-size:14px;
    font-weight:700;

    text-decoration:none;
}

.book-title{
    color:#fff;
    margin-top:12px;
    font-size:15px;
    font-weight:700;

    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap;
}

.empty-books{
    color:#fff;
}

@media(max-width:1600px){

    .book-grid{
        grid-template-columns:repeat(5,1fr);
    }

}

@media(max-width:1200px){

    .book-grid{
        grid-template-columns:repeat(4,1fr);
    }

}

@media(max-width:900px){

    .book-grid{
        grid-template-columns:repeat(3,1fr);
    }

}

@media(max-width:600px){

    .book-grid{
        grid-template-columns:repeat(2,1fr);
    }

}


</style>


</head>

<body>


@include('includes.header')

<main>

    @yield('content')

</main>

@include('includes.footer')

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function(){

    const banner = document.querySelector('.bannerSwiper');

    if(banner){

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

    }

});

</script>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>

toastr.options = {

    closeButton:true,

    progressBar:true,

    newestOnTop:true,

    preventDuplicates:true,

    positionClass:"toast-top-right",

    timeOut:3000

};

</script>

@if($errors->any())

<script>

@foreach($errors->all() as $error)

toastr.error(@json($error));

@endforeach

</script>

@endif

@if(session('success'))

<script>

toastr.success(@json(session('success')));

</script>

@endif

@if(session('error'))

<script>

toastr.error(@json(session('error')));

</script>

@endif

@if(session('warning'))

<script>

toastr.warning(@json(session('warning')));

</script>

@endif

@if(session('info'))

<script>

toastr.info(@json(session('info')));

</script>

@endif

</body>
</html>


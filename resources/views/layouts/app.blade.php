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
main {
    padding-top: 78px;
}
    .more{
    display:inline-block;
    margin-top:12px;
    color:#18c29c;
    font-weight:600;
    text-decoration:none;
}
.rvs-wrap {
    padding: 2rem 0;
    font-family: inherit;
    color: #e8e8e8;
    box-sizing: border-box;
}
.rvs-title {
    font-size: 20px;
    font-weight: 500;
    color: #fff;
    margin: 0 0 1.5rem;
    line-height: 1.4;
}
.rvs-title em {
    font-style: italic;
    color: #a0c4ff;
}

/* ── Tab bar ── */
.rvs-tabbar {
    display: flex;
    gap: 4px;
    background: #1a1a1a;
    border: 1px solid #2a2a2a;
    border-radius: 14px;
    padding: 4px;
    margin-bottom: 1.5rem;
}
.rvs-tab {
    flex: 1;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 10px 8px;
    border: 1px solid transparent;
    background: transparent;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 500;
    color: #666;
    cursor: pointer;
    transition: color .2s, background .2s, border-color .2s;
    white-space: nowrap;
    line-height: 1;
}
.rvs-tab.active {
    background: #2a2a2a;
    color: #fff;
    border-color: #383838;
}
.rvs-tab:hover:not(.active) {
    color: #bbb;
}
.rvs-tab-count {
    font-weight: 400;
    color: #555;
    font-size: 12px;
}
.rvs-tab.active .rvs-tab-count {
    color: #888;
}

/* ── Panel ── */
.rvs-panel { display: block; }

/* ── Form box ── */
.rvs-formbox {
    background: #181818;
    border: 1px solid #2a2a2a;
    border-radius: 14px;
    padding: 18px 20px;
    margin-bottom: 1rem;
}
.rvs-formbox-title {
    font-size: 15px;
    font-weight: 500;
    color: #fff;
    margin: 0 0 14px;
}
.rvs-textarea {
    display: block;
    width: 100%;
    background: #222;
    border: 1px solid #333;
    color: #e8e8e8;
    border-radius: 10px;
    padding: 13px 15px;
    resize: none;
    font-family: inherit;
    font-size: 14px;
    line-height: 1.65;
    margin-bottom: 12px;
    transition: border-color .2s;
    box-sizing: border-box;
}
.rvs-textarea::placeholder { color: #555; }
.rvs-textarea:focus {
    outline: none;
    border-color: #555;
}

/* ── Star rating picker ── */
.rvs-starpicker {
    display: flex;
    align-items: center;
    gap: 4px;
    margin-bottom: 14px;
}
.rvs-star-btn {
    background: transparent;
    border: none;
    padding: 4px;
    cursor: pointer;
    color: #3a3a3a;
    line-height: 0;
    transition: color .15s, transform .1s;
}
.rvs-star-btn svg {
    display: block;
    pointer-events: none;
}
.rvs-star-btn:hover {
    transform: scale(1.12);
}
.rvs-star-btn.is-filled {
    color: #f0a800;
}
.rvs-starpicker-label {
    margin-left: 10px;
    font-size: 13px;
    color: #888;
    font-weight: 500;
}

.rvs-select {
    display: block;
    width: 100%;
    padding: 11px 14px;
    background: #222;
    border: 1px solid #333;
    color: #e8e8e8;
    border-radius: 10px;
    font-family: inherit;
    font-size: 14px;
    margin-bottom: 12px;
    cursor: pointer;
    box-sizing: border-box;
    appearance: auto;
}
.rvs-submit {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 10px 20px;
    background: #fff;
    color: #111;
    border: none;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: opacity .15s;
    line-height: 1;
}
.rvs-submit:hover { opacity: .85; }

/* ── Cards ── */
.rvs-card {
    background: #181818;
    border: 1px solid #252525;
    border-radius: 14px;
    padding: 16px 20px;
    margin-top: 10px;
}
.rvs-card-head {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 10px;
}
.rvs-avatar {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #1e3a5f;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    font-weight: 500;
    color: #7ab8f5;
    flex-shrink: 0;
    letter-spacing: 0.5px;
}
.rvs-username {
    font-size: 14px;
    font-weight: 500;
    color: #fff;
    margin: 0;
}
.rvs-timestamp {
    font-size: 12px;
    color: #555;
    margin-top: 2px;
}
.rvs-body {
    font-size: 14px;
    line-height: 1.75;
    color: #aaa;
    margin: 0;
}
.rvs-stars {
    font-size: 14px;
    margin-top: 4px;
    line-height: 1;
}
.rvs-rating-badge {
    display: inline-flex;
    align-items: center;
    background: #2a1f00;
    color: #f0a800;
    font-size: 12px;
    font-weight: 500;
    padding: 4px 11px;
    border-radius: 20px;
    white-space: nowrap;
    flex-shrink: 0;
}

/* ── Empty state ── */
.rvs-empty {
    text-align: center;
    padding: 2.5rem 1rem;
    border: 1px dashed #2a2a2a;
    border-radius: 14px;
    margin-top: 4px;
}
.rvs-empty-icon {
    color: #333;
    display: block;
    margin: 0 auto 12px;
}
.rvs-empty-title {
    font-size: 14px;
    color: #666;
    margin: 0 0 4px;
}
.rvs-empty-sub {
    font-size: 12px;
    color: #444;
}

/* ── QA box ── */
.rvs-qabox {
    text-align: center;
    padding: 3rem 1rem;
}
.rvs-qabox-icon {
    color: #333;
    display: block;
    margin: 0 auto 14px;
}
.rvs-qabox-title {
    font-size: 14px;
    color: #777;
    margin: 0 0 6px;
}
.rvs-qabox-sub {
    font-size: 12px;
    color: #444;
}
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Inter',sans-serif;
    background:#121212;
    color:#fff;
}

.page{
    width:1400px;
    max-width:95%;
    margin:auto;
    padding:100px 0 80px;
}

/* ===== TOP ===== */

.detail{
    display:flex;
    gap:50px;
    align-items:flex-start;
}

/* ===== COVER ===== */

.cover{
    width:340px;
    flex-shrink:0;
    position:relative;
}

.cover img{
    width:100%;
    aspect-ratio: 2 / 3;   /* tỉ lệ bìa sách chuẩn, cao hơn rộng */
    object-fit: cover; 
    border-radius:10px;
    display:block;
    box-shadow:0 20px 50px rgba(0,0,0,.45);
}

.vip-tag{
    position:absolute;
    top:14px;
    left:14px;
    background:#b8860b;
    color:#fff;
    font-size:13px;
    font-weight:700;
    padding:6px 14px;
    border-radius:6px;
}

/* ===== INFO ===== */

.info{
    flex:1;
    position:relative;
}

.info:before{
    content:'';
    position:absolute;
    width:800px;
    height:800px;
    background:radial-gradient(circle,#0abf8d30 0%,transparent 70%);
    left:-250px;
    top:-250px;
    z-index:-1;
}

.title{
    font-size:58px;
    font-weight:800;
    line-height:1.15;
    margin-bottom:18px;
}

/* ===== RATE ===== */

.rating{
    display:flex;
    align-items:center;
    gap:10px;
    margin-bottom:30px;
}

.rating strong{
    font-size:24px;
}

.stars{
    color:#ffc107;
    letter-spacing:2px;
}

.rating span{
    color:#ccc;
}

/* ===== META ===== */

.meta{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:40px;
    margin-bottom:25px;
}

.meta label{
    display:block;
    color:#808080;
    margin-bottom:10px;
}

.meta div{
    font-size:22px;
    font-weight:600;
}

/* ===== LINE ===== */

.line{
    height:1px;
    background:#2d2d2d;
    margin:30px 0;
}

/* ===== OPTION ===== */

.row{
    display:flex;
    align-items:center;
    gap:20px;
    margin-bottom:15px;
}

.row span{
    color:#b9b9b9;
    width:120px;
}

.tabs{
    display:flex;
    gap:10px;
}

.tab{
    padding:12px 25px;
    border-radius:10px;
    background:#2a2a2a;
    color:#c9c9c9;
    border:none;
    cursor:pointer;
}

.tab.active{
    background:#4b5c59;
    color:#fff;
}

/* ===== ACTION ===== */

.actions{
    display:flex;
    gap:14px;
    margin:35px 0;
}

.read-btn{
    height:60px;
    min-width:220px;
    border:none;
    border-radius:35px;
    background:#18c29c;
    color:white;
    font-size:20px;
    font-weight:700;
    cursor:pointer;
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    justify-content:center;
}

.circle{
    width:60px;
    height:60px;
    border-radius:50%;
    border:none;
    background:#2f3a39;
    color:white;
    font-size:22px;
    cursor:pointer;
}

/* ===== DESC ===== */

.desc{
    max-width:900px;
    color:#e4e4e4;
    font-size:21px;
    line-height:1.9;
}

.more{
    color:#18c29c;
    text-decoration:none;
}

/* ===== REVIEW ===== */

.review{
    margin-top:80px;
}

.review h2{
    font-size:46px;
    margin-bottom:25px;
    font-weight:800;
}

.review-menu{
    display:flex;
    gap:40px;
    border-bottom:1px solid #252525;
    padding-bottom:15px;
}

.review-menu a{
    color:#18c29c;
    text-decoration:none;
    font-size:22px;
}

.empty-state{
    margin-top:25px;
    color:#666;
    font-size:18px;
}

/* ===== MOBILE ===== */

@media(max-width:1000px){

    .detail{
        flex-direction:column;
    }

    .cover{
        width:100%;
        max-width:350px;
    }

    .title{
        font-size:40px;
    }

    .meta{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:700px){

    .meta{
        grid-template-columns:1fr;
    }

    .title{
        font-size:32px;
    }

    .review h2{
        font-size:30px;
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


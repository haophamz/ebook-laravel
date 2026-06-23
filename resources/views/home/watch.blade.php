@extends('layouts.app')

@section('content')

<style>
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

<div class="page">

    <div class="detail">

        <div class="cover">
            <img src="{{ asset('storage/'.$book->cover) }}" alt="{{ $book->title }}">
            @if($book->is_vip)
                <div class="vip-tag">HỘI VIÊN</div>
            @endif
        </div>

        <div class="info">

            <h1 class="title">
                {{ $book->title }}
            </h1>

            <div class="rating">
                <strong>5.0</strong>
                <div class="stars">★★★★★</div>
                <span>1 đánh giá</span>
            </div>

            <div class="meta">

                <div>
                    <label>Tác giả</label>
                    <div>{{ $book->author ?? 'Đang cập nhật' }}</div>
                </div>

                <div>
                    <label>Thể loại</label>
                    <div>{{ $book->category->name ?? 'Sách điện tử' }}</div>
                </div>



                <div>
                    <label>Gói cước</label>
                    <div>{{ $book->is_vip ? 'Hội viên' : 'Miễn phí' }}</div>
                </div>

            </div>

            <div class="line"></div>

            <div class="row">
    
                <div class="tabs">
    
                </div>
            </div>

            <div class="row">
  
                <div class="tabs">

                </div>
            </div>

<div class="actions">

    <a href="#" class="read-btn">
        Đọc sách
    </a>

    <form action="{{ route('book.favorite',$book) }}"
          method="POST">

        @csrf

        <button type="submit" class="circle favorite-btn">

            @if($isFavorite)
                ❤️
            @else
                🤍
            @endif

        </button>

    </form>

</div>

            <div class="desc">
                {!! nl2br(e($book->description)) !!}
            </div>

        </div>

    </div>

    <div class="review">

        <h2>
            Độc giả nói gì về "{{ $book->title }}"
        </h2>

        <div class="review-menu">
            <a href="#">Bình luận (0)</a>
            <a href="#">Đánh giá &amp; nhận xét</a>
            <a href="#">Hỏi đáp về cuốn sách này</a>
        </div>

        <div class="empty-state">
            Chưa có bình luận nào. Hãy là người đầu tiên!
        </div>

    </div>

</div>

@endsection
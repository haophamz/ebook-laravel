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

    <strong>
        {{ number_format($avgRating ?? 0,1) }}
    </strong>

    <div class="stars">
        @for($i = 1; $i <= 5; $i++)

            @if($i <= round($avgRating ?? 0))
                ★
            @else
                ☆
            @endif

        @endfor
    </div>

    <span>
        {{ $reviewCount ?? 0 }} đánh giá
    </span>

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

{{-- ============================================================
     review.blade.php  –  Section bình luận / đánh giá / hỏi đáp
     CSS prefix: rvs-  (tránh xung đột với Bootstrap/global CSS)
     ============================================================ --}}

<div class="rvs-wrap">

    <h2 class="rvs-title">
        Độc giả nói gì về <em>"{{ $book->title }}"</em>
    </h2>

    {{-- TAB BAR --}}
    <div class="rvs-tabbar" role="tablist">

        <button class="rvs-tab active"
                onclick="rvsSwitchTab('comments', this)"
                role="tab">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 aria-hidden="true" style="vertical-align:-2px;flex-shrink:0">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>
            Bình luận
            <span class="rvs-tab-count">({{ isset($comments) ? $comments->count() : 0 }})</span>
        </button>

        <button class="rvs-tab"
                onclick="rvsSwitchTab('reviews', this)"
                role="tab">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 aria-hidden="true" style="vertical-align:-2px;flex-shrink:0">
                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
            </svg>
            Đánh giá
            <span class="rvs-tab-count">({{ $reviewCount ?? 0 }})</span>
        </button>

        <button class="rvs-tab"
                onclick="rvsSwitchTab('qa', this)"
                role="tab">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 aria-hidden="true" style="vertical-align:-2px;flex-shrink:0">
                <circle cx="12" cy="12" r="10"/>
                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                <line x1="12" y1="17" x2="12.01" y2="17"/>
            </svg>
            Hỏi đáp
        </button>

    </div>

    {{-- ===================== BÌNH LUẬN ===================== --}}
    <div id="rvs-tab-comments" class="rvs-panel">

        @auth
        <div class="rvs-formbox">
            <form action="{{ route('comments.store', $book) }}" method="POST">
                @csrf
                <textarea class="rvs-textarea"
                          name="content"
                          rows="3"
                          placeholder="Chia sẻ cảm nhận của bạn về cuốn sách..."></textarea>
                <button type="submit" class="rvs-submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         aria-hidden="true">
                        <line x1="22" y1="2" x2="11" y2="13"/>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                    </svg>
                    Gửi bình luận
                </button>
            </form>
        </div>
        @endauth

        @if(isset($comments) && $comments->count())
            @foreach($comments as $comment)
                <div class="rvs-card">
                    <div class="rvs-card-head">
                        <div class="rvs-avatar">
                            {{ strtoupper(substr($comment->user->name, 0, 2)) }}
                        </div>
                        <div>
                            <div class="rvs-username">{{ $comment->user->name }}</div>
                            <div class="rvs-timestamp">{{ $comment->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    <p class="rvs-body">{{ $comment->content }}</p>
                </div>
            @endforeach
        @else
            <div class="rvs-empty">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                     aria-hidden="true" class="rvs-empty-icon">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                </svg>
                <p class="rvs-empty-title">Chưa có bình luận nào.</p>
                <span class="rvs-empty-sub">Hãy là người đầu tiên chia sẻ!</span>
            </div>
        @endif

    </div>

    {{-- ===================== ĐÁNH GIÁ ===================== --}}
    <div id="rvs-tab-reviews" class="rvs-panel" style="display:none">

        @auth
        <div class="rvs-formbox">
            <h3 class="rvs-formbox-title">Gửi đánh giá của bạn</h3>
            <form action="{{ route('reviews.store', $book) }}" method="POST">
                @csrf
                <select class="rvs-select" name="rating">
                    <option value="5">⭐⭐⭐⭐⭐ — Xuất sắc</option>
                    <option value="4">⭐⭐⭐⭐ — Rất tốt</option>
                    <option value="3">⭐⭐⭐ — Tạm ổn</option>
                    <option value="2">⭐⭐ — Chưa hay</option>
                    <option value="1">⭐ — Thất vọng</option>
                </select>
                <textarea class="rvs-textarea"
                          name="content"
                          rows="3"
                          placeholder="Nhận xét chi tiết..."></textarea>
                <button type="submit" class="rvs-submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         aria-hidden="true">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                    </svg>
                    Gửi đánh giá
                </button>
            </form>
        </div>
        @endauth

        @if(isset($reviews) && $reviews->count())
            @foreach($reviews as $review)
                <div class="rvs-card">
                    <div class="rvs-card-head">
                        <div class="rvs-avatar">
                            {{ strtoupper(substr($review->user->name, 0, 2)) }}
                        </div>
                        <div style="flex:1">
                            <div class="rvs-username">{{ $review->user->name }}</div>
                            <div class="rvs-stars">{{ str_repeat('⭐', $review->rating) }}</div>
                        </div>
                        <span class="rvs-rating-badge">{{ $review->rating }} / 5</span>
                    </div>
                    @if($review->content)
                        <p class="rvs-body">{{ $review->content }}</p>
                    @endif
                </div>
            @endforeach
        @else
            <div class="rvs-empty">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                     aria-hidden="true" class="rvs-empty-icon">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
                </svg>
                <p class="rvs-empty-title">Chưa có đánh giá nào.</p>
                <span class="rvs-empty-sub">Hãy để lại đánh giá đầu tiên!</span>
            </div>
        @endif

    </div>

    {{-- ===================== HỎI ĐÁP ===================== --}}
    <div id="rvs-tab-qa" class="rvs-panel" style="display:none">
        <div class="rvs-qabox">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                 aria-hidden="true" class="rvs-qabox-icon">
                <circle cx="12" cy="12" r="10"/>
                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                <line x1="12" y1="17" x2="12.01" y2="17"/>
            </svg>
            <p class="rvs-qabox-title">Chức năng hỏi đáp đang được phát triển</p>
            <span class="rvs-qabox-sub">Vui lòng quay lại sau nhé!</span>
        </div>
    </div>

</div>

{{-- ===================== CSS (prefix: rvs-) ===================== --}}
<style>
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
</style>

{{-- ===================== JS ===================== --}}
<script>
function rvsSwitchTab(name, btn) {
    document.querySelectorAll('.rvs-panel').forEach(function(p) {
        p.style.display = 'none';
    });
    document.querySelectorAll('.rvs-tab').forEach(function(b) {
        b.classList.remove('active');
    });
    document.getElementById('rvs-tab-' + name).style.display = 'block';
    btn.classList.add('active');
}
</script>
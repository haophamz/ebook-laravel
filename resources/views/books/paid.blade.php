@extends('layouts.app')

@section('content')
<section class="section" style="width:1400px; max-width:95%; margin:0 auto 40px; padding:100px 0 80px;">

    <div class="section-head">
        <h2 class="section-title">
            Sách mua lẻ
        </h2>

        <span class="book-count">
            ({{ $books->total() }} cuốn)
        </span>
    </div>

    <div class="book-grid">

        @forelse($books as $book)

            <a href="{{ route('home.watch',$book->slug) }}">
                <div class="book-card" style="position:relative;">

                    @if($book->access_type == 'vip' )
                        <div class="member-badge">
                            <img src="{{ asset('storage/img/hoivien.png') }}" alt="VIP">
                        </div>
                    @elseif($book->access_type == 'paid')
                        <div class="price-badge">
                            {{ number_format($book->price) }} VND
                        </div>
                    @elseif($book->access_type == 'free')
                        <div class="free-badge">
                            <img src="{{ asset('storage/img/free.png') }}" alt="Free">
                        </div>
                    @endif

                    <div class="book-cover">

                        @if($book->cover)
                            <img src="{{ asset('storage/'.$book->cover) }}" alt="{{ $book->title }}" class="cover-img">
                        @else
                            <img src="https://placehold.co/400x600?text=No+Cover" alt="No Cover">
                        @endif

                        <div class="book-overlay">
                            <h4>{{ $book->title }}</h4>
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($book->description),120) }}</p>
                        </div>

                    </div>

                    <div class="book-title">
                        {{ $book->title }}
                    </div>

                </div>
            </a>

        @empty

            <div style="grid-column:1/-1;text-align:center;padding:60px 0;color:#666;font-size:16px;">
                Chưa có sách mua lẻ.
            </div>

        @endforelse

    </div>

    @if($books->hasPages())
        <div class="pagination-wrapper">
            {{ $books->links('pagination::simple-bootstrap-5') }}
        </div>
    @endif

</section>

<style>
.section-head{
    display:flex;
    align-items:center;
    gap:12px;
    margin-bottom:25px;
}

.section-title{
    margin:0;
    color:#fff;
    font-size:26px;
    font-weight:700;
}

.book-count{
    color:#808080;
    font-size:15px;
    font-weight:500;
    margin-top:4px;
}

.book-grid{
    display:grid;
    grid-template-columns:repeat(6,1fr);
    gap:20px;
    width:100%;
}

.book-card{
    display:flex;
    flex-direction:column;
    width:100%;
}

.book-cover{
    position:relative;
    overflow:hidden;
    border-radius:8px;
    aspect-ratio:2/3;
    background:#1a1a1a;
}

.book-cover img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.member-badge{
    position:absolute;
    top:10px;
    right:10px;
    z-index:10;
}

.member-badge img{
    width:75px;
}

.price-badge{
    position:absolute;
    top:10px;
    right:10px;
    padding:4px 8px;
    background:#ff4081;
    color:#fff;
    border-radius:4px;
    font-size:12px;
    font-weight:700;
    z-index:10;
}

.free-badge{
    position:absolute;
    top:-5px;
    right:5px;
    z-index:10;
}

.free-badge img{
    width:100px;
}

.book-title{
    margin-top:10px;
    color:#fff;
    font-size:14px;
    font-weight:600;
    line-height:1.35;
}

.book-overlay{
    position:absolute;
    inset:0;
    background:rgba(0,0,0,.85);
    padding:15px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    opacity:0;
    transition:.25s;
}

.book-card:hover .book-overlay{
    opacity:1;
}

.book-overlay h4{
    margin:0 0 8px;
    color:#18c29c;
    font-size:15px;
    font-weight:600;
}

.book-overlay p{
    margin:0;
    color:#ccc;
    font-size:12px;
    line-height:1.5;
}

.pagination-wrapper{
    margin-top:50px;
    display:flex;
    justify-content:center;
}

.pagination-wrapper .pagination{
    display:flex;
    gap:10px;
    list-style:none;
    padding:0;
}

.pagination-wrapper .page-link{
    color:#18c29c!important;
    background:transparent!important;
    border:1px solid #18c29c!important;
    padding:8px 20px;
    border-radius:6px;
    font-weight:600;
}

.pagination-wrapper .page-link:hover{
    color:#fff!important;
    background:#18c29c!important;
    box-shadow:0 0 10px rgba(24,194,156,.4);
}

.pagination-wrapper .page-item.disabled .page-link{
    color:#444!important;
    border-color:#2d2d2d!important;
}
</style>
@endsection
@extends('account.layout')

@section('account-content')

<h1 class="page-title">
    Sách đã mua
</h1>

<div class="bookshelf-grid">

@forelse($purchasedBooks as $book)

    <a href="{{ route('home.render', $book->slug) }}"
       class="book-item">

        <div class="book-cover">
            @if($book->cover)
                <img src="{{ asset('storage/'.$book->cover) }}"
                     alt="{{ $book->title }}">
            @else
                {{-- Fallback nếu sách chưa có hình cover --}}
                <div class="book-cover-placeholder">📚</div>
            @endif
        </div>

        <div class="book-info">

            <h3>
                {{ $book->title }}
            </h3>

            <span class="owned-badge">
                <i class="ti ti-circle-check-filled"></i>
                Đã sở hữu
            </span>

        </div>

    </a>

@empty

    <div class="empty-box">

        <i class="ti ti-book-off"></i>

        <h3>
            Tủ sách trống
        </h3>

        <p>
            Bạn chưa mua hoặc sở hữu cuốn sách nào.
        </p>

    </div>

@endforelse

</div>

@if(method_exists($purchasedBooks, 'links') && $purchasedBooks->count())
<div class="pagination-wrap">
    {{ $purchasedBooks->links() }}
</div>
@endif

<style>

.page-title{
    color:#fff;
    font-size:38px;
    font-weight:800;
    margin-bottom:30px;
}

.bookshelf-grid{
    display:grid;
    grid-template-columns:repeat(5,1fr);
    gap:24px;
}

.book-item{
    text-decoration:none;
    transition:.25s;
}

.book-item:hover{
    transform:translateY(-6px);
}

.book-cover{
    height:320px;
    border-radius:16px;
    overflow:hidden;
    background:#1a1a1d;
    box-shadow:0 10px 30px rgba(0,0,0,.25);
    position: relative;
}

.book-cover img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition:.35s;
}

.book-cover-placeholder {
    width:100%;
    height:100%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:40px;
    background:#252529;
}

.book-item:hover img{
    transform:scale(1.05);
}

.book-info{
    margin-top:14px;
}

.book-info h3{
    color:#fff;
    font-size:15px;
    font-weight:700;
    line-height:1.5;
    margin-bottom:8px;

    overflow:hidden;
    display:-webkit-box;
    -webkit-line-clamp:2;
    -webkit-box-orient:vertical;
}

.owned-badge{
    display:inline-flex;
    align-items:center;
    gap:6px;
    color:#18c29c;
    font-size:13px;
    font-weight:600;
    background: rgba(24,194,156,.1);
    padding: 4px 10px;
    border-radius: 8px;
}

.owned-badge i{
    font-size:15px;
}

.empty-box{
    grid-column:1/-1;
    text-align:center;
    padding:100px 0;
}

.empty-box i{
    font-size:80px;
    color:#18c29c;
    margin-bottom:15px;
}

.empty-box h3{
    color:#fff;
    font-size:26px;
    margin-bottom:10px;
}

.empty-box p{
    color:#8b8b95;
}

.pagination-wrap{
    margin-top:35px;
}

@media(max-width:1200px){
    .bookshelf-grid{
        grid-template-columns:repeat(4,1fr);
    }
}

@media(max-width:900px){
    .bookshelf-grid{
        grid-template-columns:repeat(3,1fr);
    }
}

@media(max-width:600px){
    .bookshelf-grid{
        grid-template-columns:repeat(2,1fr);
        gap:16px;
    }

    .book-cover{
        height:260px;
    }
}

</style>

@endsection
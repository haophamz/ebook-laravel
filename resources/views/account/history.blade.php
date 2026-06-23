@extends('account.layout')

@section('account-content')

<h1 class="page-title">
    Lịch sử đọc
</h1>

<div class="bookshelf-grid">

@forelse($books as $item)

    @php
        $book = $item->book;
    @endphp

    <a href="{{ route('home.watch',$book->slug) }}"
       class="book-item">

        <div class="book-cover">

            @if($book->cover)

                <img
                    src="{{ asset('storage/'.$book->cover) }}"
                    alt="{{ $book->title }}">

            @endif

        </div>

        <div class="book-info">

            <h3>
                {{ $book->title }}
            </h3>

            <span class="read-time">

                <i class="ti ti-clock"></i>

                {{ $item->last_read_at?->diffForHumans() }}

            </span>

        </div>

    </a>

@empty

    <div class="empty-box">

        <i class="ti ti-history-off"></i>

        <h3>
            Chưa có lịch sử đọc
        </h3>

        <p>
            Hãy mở một cuốn sách để bắt đầu đọc.
        </p>

    </div>

@endforelse


</div>

@if($books->count())

<div class="pagination-wrap">


{{ $books->links() }}


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
}

.book-cover img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition:.35s;
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

.read-time{
    display:flex;
    align-items:center;
    gap:6px;

    color:#18c29c;
    font-size:13px;
}

.read-time i{
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

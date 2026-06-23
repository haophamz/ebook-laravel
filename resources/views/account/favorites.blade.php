@extends('account.layout')

@section('account-content')

<h1 class="page-title">
    Tủ sách của tôi
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

                <span>
                    {{ $book->author }}
                </span>

            </div>

        </a>

    @empty

        <div class="empty-box">

            <i class="ti ti-book-off"></i>

            <h3>
                Chưa có sách nào
            </h3>

            <p>
                Hãy thêm sách vào yêu thích để xây dựng tủ sách của bạn.
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

.bookshelf-grid{
    display:grid;
    grid-template-columns:repeat(5,1fr);
    gap:24px;
}

.book-item{
    text-decoration:none;
}

.book-cover{
    height:320px;
    border-radius:16px;
    overflow:hidden;
    background:#1a1a1d;
}

.book-cover img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition:.3s;
}

.book-item:hover img{
    transform:scale(1.05);
}

.book-info{
    margin-top:12px;
}

.book-info h3{
    color:#fff;
    font-size:15px;
    margin-bottom:6px;
}

.book-info span{
    color:#8b8b95;
    font-size:13px;
}

.empty-box{
    grid-column:1/-1;
    text-align:center;
    padding:100px 0;
}

.empty-box i{
    font-size:70px;
    color:#18c29c;
}

.empty-box h3{
    color:#fff;
    margin-top:15px;
}

.empty-box p{
    color:#8b8b95;
    margin-top:10px;
}

.pagination-wrap{
    margin-top:30px;
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
    }

}

</style>

@endsection
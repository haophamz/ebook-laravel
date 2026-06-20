@extends('layouts.quanli')
@include('includes.alert')
@section('content')

<div class="page-head">
    <h1>Danh sách Ebook</h1>
    <p>Quản lý tất cả ebook trong hệ thống.</p>
</div>

<div class="card">

<div class="table-head">

    <div>
        <h3>Ebook</h3>
        <span>{{ $books->total() }} sách</span>
    </div>

    <a href="{{ route('admin.books.create') }}"
       class="btn-create">
        Thêm Ebook
    </a>

</div>

<div class="table-wrap">

    <table class="table">

        <thead>
            <tr>
                <th>ID</th>
                <th>Ảnh</th>
                <th>Tên sách</th>
                <th>Danh mục</th>
                <th>Lượt xem</th>
                <th>VIP</th>
                <th>Top</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>

        <tbody>

        @forelse($books as $book)

            <tr>

                <td>#{{ $book->id }}</td>

                <td>
                    @if($book->cover)
                        <img src="{{ asset('storage/'.$book->cover) }}"
                             class="book-cover">
                    @else
                        <div class="no-cover">
                            No Image
                        </div>
                    @endif
                </td>

                <td>
                    <div class="book-title">
                        {{ $book->title }}
                    </div>

                    <div class="book-author">
                        {{ $book->author ?? 'Không rõ tác giả' }}
                    </div>
                </td>

                <td>
                    {{ $book->category->name ?? '-' }}
                </td>

                <td>
                    {{ number_format($book->views) }}
                </td>

                <td>
                    {{ $book->is_vip ? 'Có' : 'Không' }}
                </td>

                <td>
                    {{ $book->is_top ? 'Có' : 'Không' }}
                </td>

                <td>
                    @if($book->status == 'published')
                        <span class="status published">
                            Xuất bản
                        </span>
                    @else
                        <span class="status draft">
                            Bản nháp
                        </span>
                    @endif
                </td>

                <td>

                    <div class="action-group">

                        <a href="{{ route('admin.books.edit', $book->id) }}"
                           class="btn-edit">
                            Sửa
                        </a>

                        <form action="{{ route('admin.books.destroy', $book->id) }}"
                              method="POST"
 class="delete-form">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn-delete">
                                Xóa
                            </button>

                        </form>

                    </div>

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="9" class="empty">
                    Chưa có ebook nào
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

<div class="pagination-wrap">
    {{ $books->links() }}
</div>
```

</div>

<style>

.card{
    background:#fff;
    border:1px solid #ececec;
    border-radius:18px;
    padding:24px;
}

.table-head{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.table-head h3{
    margin:0;
    font-size:18px;
}

.table-head span{
    color:#888;
    font-size:13px;
}

.btn-create{
    background:#111827;
    color:#fff;
    text-decoration:none;
    padding:10px 16px;
    border-radius:10px;
    font-size:14px;
    font-weight:600;
}

.table-wrap{
    overflow-x:auto;
}

.table{
    width:100%;
    border-collapse:collapse;
}

.table th{
    background:#fafafa;
    color:#555;
    font-size:13px;
    text-align:left;
    padding:14px;
    border-bottom:1px solid #ececec;
}

.table td{
    padding:14px;
    border-bottom:1px solid #f3f4f6;
    vertical-align:middle;
}

.book-cover{
    width:55px;
    height:75px;
    object-fit:cover;
    border-radius:10px;
}

.no-cover{
    width:55px;
    height:75px;
    background:#f3f4f6;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:10px;
    color:#999;
}

.book-title{
    font-weight:600;
    margin-bottom:4px;
}

.book-author{
    font-size:13px;
    color:#777;
}

.status{
    padding:5px 10px;
    border-radius:999px;
    font-size:12px;
    font-weight:600;
}

.published{
    background:#dcfce7;
    color:#166534;
}

.draft{
    background:#f3f4f6;
    color:#374151;
}

.action-group{
    display:flex;
    gap:8px;
}

.btn-edit{
    text-decoration:none;
    background:#f3f4f6;
    color:#111827;
    padding:8px 14px;
    border-radius:10px;
    font-size:13px;
    font-weight:600;
}

.btn-delete{
    border:none;
    background:#ef4444;
    color:#fff;
    padding:8px 14px;
    border-radius:10px;
    font-size:13px;
    font-weight:600;
    cursor:pointer;
}

.empty{
    text-align:center;
    color:#999;
    padding:30px !important;
}

.pagination-wrap{
    margin-top:20px;
}

</style>

@endsection

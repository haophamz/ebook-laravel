@extends('layouts.quanli')

@section('content')

<div class="page-header">
    <h1>Bản nháp Ebook</h1>
    <p>Quản lý các ebook chưa được xuất bản.</p>
</div>

<div class="card">

    <div class="card-top">
        <div>
            <h3>Danh sách bản nháp</h3>
            <span>{{ $books->total() }} ebook</span>
        </div>

        <a href="{{ route('admin.books.create') }}" class="btn-primary">
            Thêm Ebook
        </a>
    </div>

    @if($books->count())

    <div class="table-wrap">

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sách</th>
                    <th>Ngày tạo</th>
                    <th width="120">Hành động</th>
                </tr>
            </thead>

            <tbody>

            @foreach($books as $book)
                <tr>
                    <td>{{ $book->id }}</td>

                    <td>
                        <strong>{{ $book->title }}</strong>
                    </td>

                    <td>
                        {{ $book->created_at->format('d/m/Y') }}
                    </td>

                    <td>
                        <a href="{{ route('admin.books.edit',$book) }}"
                           class="btn-edit">
                            Sửa
                        </a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

    </div>

    <div class="pagination-box">
        {{ $books->links() }}
    </div>

    @else

    <div class="empty-box">
        <h3>Chưa có bản nháp nào</h3>
        <p>Tạo ebook mới để bắt đầu.</p>
    </div>

    @endif

</div>

<style>
.page-header{
    margin-bottom:20px;
}

.page-header h1{
    font-size:28px;
    margin:0;
}

.page-header p{
    color:#6b7280;
    margin-top:5px;
}

.card{
    background:#fff;
    border-radius:16px;
    border:1px solid #e5e7eb;
    overflow:hidden;
}

.card-top{
    padding:20px 24px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    border-bottom:1px solid #e5e7eb;
}

.card-top h3{
    margin:0;
}

.card-top span{
    color:#6b7280;
    font-size:14px;
}

.table{
    width:100%;
    border-collapse:collapse;
}

.table th{
    background:#f9fafb;
    padding:14px 20px;
    text-align:left;
    font-weight:600;
}

.table td{
    padding:16px 20px;
    border-top:1px solid #f1f5f9;
}

.table tr:hover{
    background:#fafafa;
}

.btn-primary{
    background:#111827;
    color:#fff;
    text-decoration:none;
    padding:10px 16px;
    border-radius:8px;
    font-size:14px;
}

.btn-edit{
    color:#2563eb;
    text-decoration:none;
    font-weight:600;
}

.pagination-box{
    padding:20px;
    border-top:1px solid #e5e7eb;
}

.empty-box{
    text-align:center;
    padding:60px 20px;
}

.empty-box h3{
    margin-bottom:10px;
}

.empty-box p{
    color:#6b7280;
}
</style>

@endsection
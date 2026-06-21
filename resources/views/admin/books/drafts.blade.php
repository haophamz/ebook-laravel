@extends('layouts.quanli')

@include('includes.alert')

@section('styles')
@include('admin.partials.admin-ui')
@endsection

@section('content')

<div class="page-head">
    <div>
        <h1>Bản nháp Ebook</h1>
        <p>Quản lý các ebook chưa được xuất bản.</p>
    </div>
</div>

<div class="card">


<div class="table-head">

    <div>
        <h3>Danh sách bản nháp</h3>
        <span>{{ $books->total() }} ebook</span>
    </div>

</div>

@if($books->count())

    <div class="table-wrap">

        <table class="table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sách</th>
                    <th>Ngày tạo</th>
                    <th width="140">Thao tác</th>
                </tr>
            </thead>

            <tbody>

            @foreach($books as $book)

                <tr>

                    <td>#{{ $book->id }}</td>

                    <td>
                        <strong>{{ $book->title }}</strong>
                    </td>

                    <td>
                        {{ $book->created_at->format('d/m/Y') }}
                    </td>

                    <td class="action-cell">

                        <div class="action-group">

                            <a href="{{ route('admin.books.edit',$book) }}"
                               class="btn-edit">
                                Sửa
                            </a>

                        </div>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

    <div class="card-footer">
            {{ $books->links() }}

        </div>

    </div>

@else

    <div class="card-body">

        <div class="text-center">
            Chưa có bản nháp nào.
        </div>

        <div style="margin-top:16px;text-align:center;">
        </div>

    </div>

@endif


</div>

@endsection

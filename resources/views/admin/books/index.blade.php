@extends('layouts.quanli')

@include('includes.alert')

@section('styles')
@include('admin.partials.admin-ui')
@endsection

@section('content')

<div class="page-head">
    <div>
        <h1>Danh sách Ebook</h1>
        <p>Quản lý tất cả ebook trong hệ thống.</p>
    </div>
</div>

<div class="card">
<div class="table-head">
     <form method="GET" class="search-form">

        @if(request('type'))
            <input type="hidden"
                   name="type"
                   value="{{ request('type') }}">
        @endif

        <input type="text"
               name="keyword"
               value="{{ request('keyword') }}"
               placeholder="Tìm kiếm ebook...">

        <button type="submit">
            Tìm kiếm
        </button>

    </form>

    <a href="{{ route('admin.books.create') }}"
       class="btn-create">
        + Thêm Ebook
    </a>

</div>

<div class="card-body">

   

    <div class="filters">

        <a href="{{ route('admin.books.index') }}"
           class="{{ !request('type') ? 'active' : '' }}">
            Tất cả
        </a>
        <a href="{{ route('admin.books.index',['type'=>'vip']) }}"
           class="{{ request('type') == 'vip' ? 'active' : '' }}">
            VIP
        </a>
        <a href="{{ route('admin.books.index',['type'=>'banner']) }}"
           class="{{ request('type') == 'banner' ? 'active' : '' }}">
            Banner
        </a>
<a href="{{ route('admin.books.index',['type'=>'featured']) }}" class="{{ request('type') == 'featured' ? 'active' : '' }}"> Nổi bật </a>
    </div>

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
                <th>Banner</th>
                <th>Trạng thái</th>
                <th width="180">Thao tác</th>
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

                    @if($book->is_vip)
                        <span class="badge bg-warning">
                            Có
                        </span>
                    @else
                        <span class="badge bg-secondary">
                            Không
                        </span>
                    @endif

                </td>

                <td>

                    @if($book->is_top)
                        <span class="badge bg-warning">
                            Có
                        </span>
                    @else
                        <span class="badge bg-secondary">
                            Không
                        </span>
                    @endif

                </td>

                <td>

                    @if($book->status == 'published')

                        <span class="status-link status-active">
                            Xuất bản
                        </span>

                    @else

                        <span class="status-link status-locked">
                            Bản nháp
                        </span>

                    @endif

                </td>

                <td class="action-cell">

                    <div class="action-group">

                        <a href="{{ route('admin.books.edit',$book->id) }}"
                           class="btn-edit">
                            Sửa
                        </a>

                        <form action="{{ route('admin.books.destroy',$book->id) }}"
                              method="POST"
                              class="delete-form"
                              style="display:inline;">

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

                <td colspan="9"
                    class="text-center">

                    Chưa có ebook nào

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

<div class="card-footer">
    {{ $books->withQueryString()->links() }}
</div>


</div>

@endsection

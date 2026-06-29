@extends('layouts.quanli')

@include('includes.alert')

@section('styles')
    @include('admin.partials.admin-ui')
@endsection

@section('content')

<div class="page-head">
    <div>
        <h1>Danh sách Ebook</h1>
        <p>Tổng số ebook: {{ $books->total() }} sách</p>
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

            <a href="{{ route('admin.books.index',['type'=>'free']) }}"
               class="{{ request('type') == 'free' ? 'active' : '' }}">
                Free
            </a>

            <a href="{{ route('admin.books.index',['type'=>'vip']) }}"
               class="{{ request('type') == 'vip' ? 'active' : '' }}">
                VIP
            </a>

            <a href="{{ route('admin.books.index',['type'=>'paid']) }}"
               class="{{ request('type') == 'paid' ? 'active' : '' }}">
                Bán lẻ
            </a>

            <a href="{{ route('admin.books.index',['type'=>'banner']) }}"
               class="{{ request('type') == 'banner' ? 'active' : '' }}">
                Banner
            </a>

            <a href="{{ route('admin.books.index',['type'=>'featured']) }}"
               class="{{ request('type') == 'featured' ? 'active' : '' }}">
                Nổi bật
            </a>

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
                    <th>Loại truy cập</th>
                    <th>Giá bán</th>
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

                        @if($book->access_type == 'free')

                            <span class="status active">
                                FREE
                            </span>

                        @elseif($book->access_type == 'vip')

                            <span class="status warning">
                                VIP
                            </span>

                        @elseif($book->access_type == 'paid')

                            <span class="status inactive">
                                BÁN
                            </span>

                        @else

                            <span class="status active">
                                FREE
                            </span>

                        @endif

                    </td>

                    <td>

                        @if($book->access_type == 'paid')

                            {{ number_format($book->price) }}đ

                        @else

                            -

                        @endif

                    </td>

                    <td>

                        @if($book->is_top)

                            <span class="status active">
                                Có
                            </span>

                        @else

                            <span class="status inactive">
                                Không
                            </span>

                        @endif

                    </td>

                    <td>

                        @if($book->status == 'published')

                            <span class="status active">
                                Xuất bản
                            </span>

                        @else

                            <span class="status inactive">
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
                                        class="btn-delete"
                                        onclick="return confirm('Bạn có chắc muốn xóa ebook này?')">
                                    Xóa
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="10"
                        class="text-center"
                        style="padding:40px;">

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
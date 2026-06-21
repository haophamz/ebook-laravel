@extends('layouts.quanli')

@include('includes.alert')

@section('styles')
    @include('admin.partials.admin-ui')
@endsection

@section('content')

<div class="page-head">
    <div>
        <h1>Danh mục</h1>
        <p>Quản lý danh mục ebook.</p>
    </div>
</div>

<div class="card">

    <div class="table-head">

        <div>
            <h3>Danh mục</h3>
            <span>{{ $categories->total() }} danh mục</span>
        </div>

        <a href="{{ route('admin.categories.create') }}"
           class="btn-create">
           
            + Thêm danh mục
        </a>

    </div>

    <table class="table">

        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Slug</th>

                <th width="180">Thao tác</th>
            </tr>
        </thead>

        <tbody>

        @foreach($categories as $category)

            <tr>

                <td>#{{ $category->id }}</td>

                <td>{{ $category->name }}</td>

                <td>{{ $category->slug }}</td>

                <td class="action-cell">

                    <div class="action-group">

                        <a href="{{ route('admin.categories.edit',$category->id) }}"
                           class="btn-edit">
                            Sửa
                        </a>

                        <form action="{{ route('admin.categories.destroy',$category->id) }}"
                              method="POST"
                              class="delete-form"
                              style="display:inline;">

                            @csrf
                            @method('DELETE')

                            <button class="btn-delete">
                                Xóa
                            </button>

                        </form>

                    </div>

                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

    {{ $categories->links() }}

</div>

@endsection
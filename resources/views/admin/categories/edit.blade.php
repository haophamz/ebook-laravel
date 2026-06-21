@extends('layouts.quanli')

@section('styles')
    @include('admin.partials.admin-ui')
@endsection

@section('content')

<a href="{{ route('admin.categories.index') }}" class="page-head-back">
    ← Quay lại danh sách
</a>

<div class="page-head">
    <div>
        <h1>Chỉnh sửa danh mục</h1>
        <p>Cập nhật thông tin danh mục ebook.</p>
    </div>
</div>

<div class="card" style="max-width:640px;">

    <form action="{{ route('admin.categories.update', $category->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="card-body">

            <div class="form-group">
                <label for="name" class="form-label">Tên danh mục</label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name', $category->name) }}"
                       required
                       class="form-control @error('name') is-invalid @enderror">
                @error('name')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="slug" class="form-label">Slug</label>
                <input type="text"
                       id="slug"
                       value="{{ $category->slug }}"
                       disabled
                       class="form-control">
                <div class="form-hint">Slug được tạo tự động, không thể sửa trực tiếp</div>
            </div>

        </div>

        <div class="card-footer">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-light">
                Quay lại
            </a>
            <button type="submit" class="btn btn-primary">
                Cập nhật
            </button>
        </div>

    </form>

</div>

@endsection
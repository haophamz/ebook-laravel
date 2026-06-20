
@extends('layouts.quanli')

@section('content')

<div class="page-header">
    <h1>Upload Ebook</h1>
    <p>Thêm sách EPUB mới vào thư viện.</p>
</div>

<div class="card">

    <form action="{{ route('admin.books.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="field">
            <label>Tên sách</label>
            <input type="text"
                   name="title"
                   required>
        </div>

        <div class="field">
            <label>Tác giả</label>
            <input type="text"
                   name="author">
        </div>

        <div class="field">
            <label>Ảnh bìa</label>
            <input type="file"
                   name="cover"
                   accept="image/*">
        </div>

        <div class="field">
            <label>File EPUB</label>
            <input type="file"
                   name="epub_file"
                   accept=".epub"
                   required>
        </div>

        <div class="field">
            <label>Mô tả</label>

            <textarea
                name="description"
                rows="6">
            </textarea>
        </div>

        <button class="btn-primary">
            Upload Ebook
        </button>

    </form>

</div>

@endsection


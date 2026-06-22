@extends('layouts.quanli')

@section('content')

<div class="page-head">
    <h1>Thêm danh mục</h1>
    <p>Tạo danh mục mới cho hệ thống Ebook.</p>
</div>

<div class="card category-card">

<form action="{{ route('admin.categories.store') }}"
      method="POST">

    @csrf

    <div class="form-group">

        <label>Tên danh mục</label>

        <input type="text"
               name="name"
               class="input"
               placeholder="Ví dụ: Lập trình"
               value="{{ old('name') }}"
               required>

    </div>
<div class="field">
    <label>
        <input type="checkbox"
               name="status"
               value="1"
               checked>

        Hiển thị danh mục
    </label>
</div>
    <div class="actions">

        <a href="{{ route('admin.categories.index') }}"
           class="btn-back">
            Quay lại
        </a>

        <button type="submit"
                class="btn-upload">
            Lưu danh mục
        </button>

    </div>

</form>


</div>

<style>

.category-card{
    max-width:700px;
    background:#fff;
    border:1px solid #ececec;
    border-radius:18px;
    padding:28px;
}

.form-group{
    margin-bottom:24px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-size:14px;
    font-weight:600;
    color:#111827;
}

.input{
    width:100%;
    height:48px;
    border:1px solid #d1d5db;
    border-radius:12px;
    padding:0 16px;
    font-size:14px;
    transition:.2s;
}

.input:focus{
    outline:none;
    border-color:#111827;
}

.actions{
    display:flex;
    justify-content:flex-end;
    gap:10px;
    padding-top:20px;
    border-top:1px solid #f3f4f6;
}

.btn-back{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    height:42px;
    padding:0 16px;
    text-decoration:none;
    background:#f3f4f6;
    color:#111827;
    border-radius:10px;
    font-size:14px;
    font-weight:600;
}

.btn-upload{
    height:42px;
    padding:0 18px;
    border:none;
    border-radius:10px;
    background:#111827;
    color:#fff;
    font-size:14px;
    font-weight:600;
    cursor:pointer;
}

.btn-upload:hover{
    background:#000;
}

</style>

@endsection

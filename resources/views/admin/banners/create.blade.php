@extends('layouts.quanli')

@include('includes.alert')

@section('styles')
@include('admin.partials.admin-ui')
@endsection

@section('content')

<div class="page-head">


<div>
    <h1>Thêm Banner</h1>
    <p>Tạo banner mới cho trang chủ.</p>
</div>


</div>

<div class="card">


<form action="{{ route('admin.banners.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <div class="card-body">

        <div class="field">

            <label>Ảnh Banner</label>

            <input type="file"
                   name="image"
                   required>

            @error('image')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <div class="field">

            <label>Link</label>

            <input type="text"
                   name="url"
                   value="{{ old('url') }}"
                   class="form-control"
                   placeholder="https://example.com">

        </div>

        <div class="field">

            <label>Thứ tự hiển thị</label>

            <input type="number"
                   name="sort_order"
                   value="0"
                   class="form-control">

        </div>

        <div class="field">

            <label>

                <input type="checkbox"
                       name="status"
                       value="1"
                       checked>

                Hiển thị banner

            </label>

        </div>

    </div>

    <div class="card-footer">

        <div class="action-group">

            <button type="submit"
                    class="btn-create">
                Lưu Banner
            </button>

            <a href="{{ route('admin.banners.index') }}"
               class="btn-edit">
                Quay lại
            </a>

        </div>

    </div>

</form>


</div>

@endsection

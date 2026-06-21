@extends('layouts.quanli')

@include('includes.alert')

@section('styles')
@include('admin.partials.admin-ui')
@endsection

@section('content')

<div class="page-head">


<div>
    <h1>Chỉnh sửa Banner</h1>
    <p>Cập nhật thông tin banner.</p>
</div>


</div>

<div class="card">


<form action="{{ route('admin.banners.update', $banner) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="card-body">

        <div class="field">

            <label>Ảnh hiện tại</label>

            <div style="margin-top:10px;">

                <img src="{{ asset('storage/'.$banner->image) }}"
                     alt="Banner"
                     style="max-width:500px;width:100%;border-radius:12px;border:1px solid #e5e7eb;">

            </div>

        </div>

        <div class="field">

            <label>Ảnh mới</label>

            <input type="file"
                   name="image">

            <small>
                Để trống nếu không muốn thay ảnh.
            </small>

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
                   value="{{ old('url', $banner->url) }}"
                   class="form-control"
                   placeholder="https://example.com">

        </div>

        <div class="field">

            <label>Thứ tự hiển thị</label>

            <input type="number"
                   name="sort_order"
                   value="{{ old('sort_order', $banner->sort_order) }}"
                   class="form-control">

        </div>

        <div class="field">

            <label>

                <input type="checkbox"
                       name="status"
                       value="1"
                       {{ $banner->status ? 'checked' : '' }}>

                Hiển thị banner

            </label>

        </div>

    </div>

    <div class="card-footer">

        <div class="action-group">

            <button type="submit"
                    class="btn-create">
                Cập nhật
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

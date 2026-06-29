@extends('layouts.quanli')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/books/upload.css') }}">

<div class="upload-page">
    <div class="page-head">
        <h1>Chỉnh sửa Ebook</h1>
        <p>Cập nhật thông tin ebook.</p>
    </div>

    <form action="{{ route('admin.books.update', $book->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="upload-layout">
            {{-- CỘT TRÁI --}}
            <div>
                <div class="card" style="margin-bottom:16px">
                    <div class="section-label">Thông tin sách</div>
                    
                    <div class="form-group">
                        <label>Tên sách</label>
                        <input type="text" name="title" value="{{ old('title', $book->title) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Tác giả</label>
                        <input type="text" name="author" value="{{ old('author', $book->author) }}">
                    </div>

                    <div class="form-group">
                        <label>Danh mục</label>
                        <select name="category_id">
                            <option value="">-- Chọn danh mục --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Trạng thái</label>
                        <select name="status">
                            <option value="published" {{ old('status', $book->status) == 'published' ? 'selected' : '' }}>Xuất bản</option>
                            <option value="draft" {{ old('status', $book->status) == 'draft' ? 'selected' : '' }}>Bản nháp</option>
                        </select>
                    </div>
                </div>

                <div class="card">
                    <div class="section-label">Tùy chọn hiển thị</div>
                    <div class="checkbox-grid">
                        <label class="check-item">
                            <input type="checkbox" name="featured" value="1" {{ old('featured', $book->featured) ? 'checked' : '' }}>
                            <span>Sách nổi bật</span>
                        </label>
                        <label class="check-item">
                            <input type="checkbox" name="is_top" value="1" {{ old('is_top', $book->is_top) ? 'checked' : '' }}>
                            <span>Hiển thị Banner</span>
                        </label>
                    </div>

                    {{-- Logic Loại truy cập và Giá --}}
                    <div class="form-group" style="margin-top:20px">
                        <label>Loại truy cập</label>
                        <select name="access_type" id="access_type">
                            <option value="free" {{ old('access_type', $book->access_type) == 'free' ? 'selected' : '' }}>Miễn phí</option>
                            <option value="vip" {{ old('access_type', $book->access_type) == 'vip' ? 'selected' : '' }}>VIP</option>
                            <option value="paid" {{ old('access_type', $book->access_type) == 'paid' ? 'selected' : '' }}>Bán lẻ</option>
                        </select>
                    </div>

                    <div class="form-group" id="price-box" style="{{ old('access_type', $book->access_type) == 'paid' ? '' : 'display:none' }}">
                        <label>Giá bán (VNĐ)</label>
                        <input type="number" name="price" value="{{ old('price', $book->price ?? 0) }}" min="0">
                    </div>
                </div>
            </div>

            {{-- CỘT PHẢI --}}
            <div class="card">
                <div class="section-label">Mô tả</div>
                <div class="form-group">
                    <textarea name="description" rows="6">{{ old('description', $book->description) }}</textarea>
                </div>

                <hr class="right-divider">

                <div class="section-label">Tệp đính kèm</div>
                @if($book->cover)
                    <img src="{{ asset('storage/'.$book->cover) }}" style="width:140px;border-radius:12px;margin-bottom:20px;">
                @endif

                <div class="files-grid">
                    <div class="form-group">
                        <label>Đổi ảnh bìa</label>
                        <div class="file-upload-zone">
                            <input type="file" name="cover" accept="image/*" onchange="showFileName(this,'cover-name')">
                            <span class="upload-label">Chọn ảnh mới</span>
                        </div>
                        <div class="file-name" id="cover-name"></div>
                    </div>

                    <div class="form-group">
                        <label>Đổi file EPUB</label>
                        <div class="file-upload-zone">
                            <input type="file" name="epub_file" accept=".epub" onchange="showFileName(this,'epub-name')">
                            <span class="upload-label">Chọn EPUB mới</span>
                        </div>
                        <div class="file-name" id="epub-name"></div>
                    </div>
                </div>

                <div class="actions">
                    <a href="{{ route('admin.books.index') }}" class="btn-draft">Quay lại</a>
                    <button type="submit" class="btn-upload">Cập nhật Ebook</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function showFileName(input, targetId) {
        document.getElementById(targetId).textContent = input.files?.[0]?.name ?? '';
    }

    const accessType = document.getElementById('access_type');
    const priceBox = document.getElementById('price-box');

    if (accessType) {
        accessType.addEventListener('change', function () {
            priceBox.style.display = (this.value === 'paid') ? 'block' : 'none';
        });
    }
</script>
@endsection
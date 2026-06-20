@extends('layouts.quanli')

@section('content')
<link rel="stylesheet" href="{{ asset('css/admin/books/upload.css') }}">

<div class="upload-page">

    <div class="page-head">
        <h1>Upload Ebook</h1>
        <p>Thêm ebook mới vào thư viện của bạn.</p>
    </div>

    <form action="{{ route('admin.books.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div class="upload-layout">

            {{-- ── CỘT TRÁI: Metadata + Options ── --}}
            <div>

                <div class="card" style="margin-bottom:16px">
                    <div class="section-label">Thông tin sách</div>

                    <div class="form-group">
                        <label>Tên sách</label>
                        <input type="text" name="title"
                               value="{{ old('title') }}"
                               placeholder="Những Người Khốn Khổ" required>
                    </div>

                    <div class="form-group">
                        <label>Tác giả</label>
                        <input type="text" name="author"
                               value="{{ old('author') }}"
                               placeholder="Victor Hugo">
                    </div>

                    <div class="form-group">
                        <label>Danh mục</label>
                        <select name="category_id">
                            <option value="">-- Chọn danh mục --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" style="margin-bottom:0">
                        <label>Trạng thái</label>
                        <select name="status">
                            <option value="published"
                                {{ old('status', 'published') == 'published' ? 'selected' : '' }}>
                                Xuất bản
                            </option>
                            <option value="draft"
                                {{ old('status') == 'draft' ? 'selected' : '' }}>
                                Bản nháp
                            </option>
                        </select>
                    </div>
                </div>

                <div class="card">
                    <div class="section-label">Tùy chọn hiển thị</div>

                    <div class="checkbox-grid">
                        <label class="check-item">
                            <input type="checkbox" name="featured" value="1"
                                   {{ old('featured') ? 'checked' : '' }}>
                            <span>Sách nổi bật</span>
                        </label>

                        <label class="check-item">
                            <input type="checkbox" name="is_top" value="1"
                                   {{ old('is_top') ? 'checked' : '' }}>
                            <span>Hiển thị Banner</span>
                        </label>

                        <label class="check-item">
                            <input type="checkbox" name="is_vip" value="1"
                                   {{ old('is_vip') ? 'checked' : '' }}>
                            <span>Sách VIP</span>
                        </label>
                    </div>
                </div>

            </div>

            {{-- ── CỘT PHẢI: Mô tả + Files + Actions ── --}}
            <div class="card">

                <div class="section-label">Mô tả</div>

                <div class="form-group">
                    <textarea name="description" rows="6"
                              placeholder="Nhập mô tả ngắn về nội dung ebook...">{{ old('description') }}</textarea>
                </div>

                <hr class="right-divider">
                <div class="section-label">Tệp đính kèm</div>

                <div class="files-grid">
                    <div class="form-group" style="margin-bottom:0">
                        <label>Ảnh bìa</label>
                        <div class="file-upload-zone">
                            <input type="file" name="cover" accept="image/*"
                                   onchange="showFileName(this,'cover-name')">
                            <span class="upload-label">Chọn ảnh bìa</span>
                            <span class="upload-hint">JPG, PNG, WEBP — tối đa 5 MB</span>
                        </div>
                        <div class="file-name" id="cover-name"></div>
                    </div>

                    <div class="form-group" style="margin-bottom:0">
                        <label>File EPUB</label>
                        <div class="file-upload-zone">
                            <input type="file" name="epub_file" accept=".epub" required
                                   onchange="showFileName(this,'epub-name')">
                            <span class="upload-label">Chọn file EPUB</span>
                            <span class="upload-hint">Chỉ nhận định dạng .epub</span>
                        </div>
                        <div class="file-name" id="epub-name"></div>
                    </div>
                </div>

                <div class="actions">
                    <button type="button" class="btn-cancel"
                            onclick="history.back()">Hủy</button>
                    <button type="submit" class="btn-upload">Lưu Ebook</button>
                </div>

            </div>

        </div>{{-- end .upload-layout --}}

    </form>

</div>

<script>
function showFileName(input, targetId) {
    document.getElementById(targetId).textContent = input.files?.[0]?.name ?? '';
}
</script>

@endsection
@extends('layouts.app')

@section('content')
    <section class="section" style="width:1400px; max-width:95%; margin:0 auto 40px; padding:100px 0 80px;">
        {{-- Tiêu đề danh mục: Giữ nguyên gốc --}}
        <div class="section-head">
            <h2 class="section-title">
                Danh mục: {{ $category->name }}
            </h2>
            <span class="book-count">
                ({{ $books->total() }} cuốn)
            </span>
        </div>

        {{-- Lưới hiển thị sách: Giữ nguyên gốc --}}
        <div class="book-grid">
            @forelse($books as $book)
                <a href="{{ route('home.watch', $book->slug) }}">
                    <div class="book-card" style="position: relative;"> 
                        
                        {{-- Badge hiển thị loại sách đồng bộ --}}
                        @if($book->access_type == 'vip' || $book->is_vip)
                            <div class="member-badge">
                                <img src="{{ asset('storage/img/hoivien.png') }}" alt="Hội viên">
                            </div>
                        @elseif($book->access_type == 'paid')
                            <div class="price-badge">
                                {{ number_format($book->price) }} VND
                            </div>
                        @elseif($book->access_type == 'free')
                            <div class="free-badge">
                                <img src="{{ asset('storage/img/free.png') }}" alt="free">
                            </div>
                        @endif

                        <div class="book-cover">
                            @if($book->cover)
                                <img src="{{ asset('storage/'.$book->cover) }}" alt="{{ $book->title }}" class="cover-img">
                            @else
                                <img src="https://placehold.co/400x600?text=No+Cover" alt="No Cover">
                            @endif

                            <div class="book-overlay">
                                <h4>{{ $book->title }}</h4>
                                <p>{{ \Illuminate\Support\Str::limit(strip_tags($book->description), 120) }}</p>
                                <div class="overlay-actions"></div>
                            </div>
                        </div>

                        <div class="book-title">
                            {{ $book->title }}
                        </div>
                    </div>
                </a>
            @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 60px 0; color: #666; font-size: 16px;">
                    Chưa có sách nào thuộc danh mục này.
                </div>
            @endforelse
        </div>

        {{-- KHU VỰC PHÂN TRANG XANH LÁ --}}
        @if($books->hasPages())
            <div class="pagination-wrapper">
                {{ $books->links('pagination::simple-bootstrap-5') }}
            </div>
        @endif
    </section>

<style>
/* ===== UI TIÊU ĐỀ ĐỒNG BỘ ===== */
.section-head {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    gap: 12px;
    margin-bottom: 25px;
}

.section-title {
    font-size: 26px;
    font-weight: 700;
    color: #fff;
    margin: 0;
    line-height: 1.2;
}

.book-count {
    color: #808080;
    font-size: 15px;
    font-weight: 500;
    margin-top: 4px;
}

/* ===== FIX KÍCH THƯỚC CARD KHÔNG BỊ CO GIÃN SAI LỆCH ===== */
.book-grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr); 
    gap: 20px;
    width: 100%;
}

.book-card {
    width: 100%;
    display: flex;
    flex-direction: column;
    text-decoration: none;
}

.book-cover {
    width: 100%;
    aspect-ratio: 2 / 3; 
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    background-color: #1a1a1a;
}

.book-cover img {
    width: 100%;
    height: 100%;
    object-fit: cover; 
}

/* ===== ĐỒNG BỘ BADGE TRÊN CARD SÁCH ===== */
.member-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    z-index: 10;
}
.member-badge img {
    width: 75px;
    display: block;
}

.price-badge {
    position: absolute; 
    top: 10px; 
    right: 10px; 
    background: #ff4081; 
    color: #fff; 
    padding: 4px 8px; 
    border-radius: 4px; 
    font-size: 12px; 
    font-weight: bold; 
    z-index: 10;
}

.free-badge {
    position: absolute; 
    top: -5px; 
    right: 5px; 
    z-index: 10;
}
.free-badge img {
    width: 100px;
    display: block;
}

/* ===== ĐỒNG BỘ TIÊU ĐỀ VÀ OVERLAY KHỐI SÁCH ===== */
.book-title {
    margin-top: 10px;
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    line-height: 1.3;
}

.book-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.85);
    color: #fff;
    padding: 15px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.25s ease-in-out;
    z-index: 5;
}

.book-card:hover .book-overlay {
    opacity: 1;
}

.book-overlay h4 {
    margin: 0 0 8px 0;
    font-size: 15px;
    font-weight: 600;
    color: #18c29c;
}

.book-overlay p {
    margin: 0;
    font-size: 12px;
    color: #ccc;
    line-height: 1.4;
}

/* ===== PHÂN TRANG XANH LÁ ===== */
.pagination-wrapper {
    margin-top: 50px;
    display: flex;
    justify-content: center;
}

.pagination-wrapper .pagination {
    display: flex;
    gap: 10px;
    list-style: none;
    padding: 0;
    margin: 0;
}

.pagination-wrapper .page-item .page-link {
    color: #18c29c !important;
    background-color: transparent !important;
    border: 1px solid #18c29c !important;
    padding: 8px 20px;
    font-size: 14px;
    font-weight: 600;
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.2s ease-in-out;
}

.pagination-wrapper .page-item .page-link:hover {
    color: #fff !important;
    background-color: #18c29c !important;
    box-shadow: 0 0 10px rgba(24, 194, 156, 0.4);
}

.pagination-wrapper .page-item.disabled .page-link {
    color: #444 !important;
    border-color: #2d2d2d !important;
    pointer-events: none;
}
</style>
@endsection
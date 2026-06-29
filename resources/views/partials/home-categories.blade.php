@foreach($categories as $category)
    @if($category->books->count())
        <section class="section" style="margin-bottom: 40px;">
            {{-- Tiêu đề danh mục và nút Xem thêm đi liền kề nhau --}}
            <div class="section-head">
                <h2 class="section-title">
                    {{ $category->name }}
                </h2>
                <a href="{{ route('category.show', $category->slug) }}" class="view-more-btn">
                    Xem thêm
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </a>
            </div>

            {{-- Lưới danh sách sách --}}
            <div class="book-grid">
                @foreach($category->books as $book)
                    <a href="{{ route('home.watch', $book->slug) }}">
                        <div class="book-card" style="position: relative;"> 
                            
                            {{-- Badge hiển thị loại sách đồng bộ --}}
                            @if($book->access_type == 'vip' || $book->is_vip)
                                <div class="member-badge">
                                    <img src="{{ asset('storage/img/hoivien.png') }}" alt="Hội viên">
                                </div>
                            @elseif($book->access_type == 'paid')
                                <div class="price-badge" style="position:absolute; top:10px; right:10px; background:#ff4081; color:#fff; padding:4px 8px; border-radius:4px; font-size:12px; font-weight:bold; z-index:10;">
                                    {{ number_format($book->price) }} VND
                                </div>
                            @elseif($book->access_type == 'free')
                                <div class="free-badge" style="position:absolute; top:-5px; right:5px; z-index:10;">
                                    <img src="{{ asset('storage/img/free.png') }}" alt="free" style="width: 100px;">
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
                @endforeach
            </div>
        </section>
    @endif
@endforeach

<style>
/* ===== REPOSITIONED SECTION HEAD & VIEW MORE (NO LINE) ===== */
.section-head {
    display: flex;
    justify-content: flex-start; /* Nút dính liền sau chữ */
    align-items: center;          /* Căn giữa chữ và nút theo trục dọc */
    gap: 14px;                    /* Khoảng cách giữa tên danh mục và nút xem thêm */
    margin-bottom: 20px;          /* Khoảng cách vừa vặn, thông thoáng với card ảnh bên dưới */
}

.section-title {
    font-size: 24px;
    font-weight: 700;
    color: #fff;
    margin: 0;
    line-height: 1.2;
}

.view-more-btn {
    color: #18c29c;
    font-size: 14px;              
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 3px;
    transition: all 0.2s ease-in-out;
    padding: 4px 10px;
    border-radius: 6px;
    margin-top: 2px;              /* Cân bằng baseline chữ */
}

.view-more-btn svg {
    display: block;
    transition: transform 0.2s ease-in-out;
}

/* Hiệu ứng hover nút */
.view-more-btn:hover {
    color: #1fe0b5;
    background: rgba(24, 194, 156, 0.1); 
}

.view-more-btn:hover svg {
    transform: translateX(3px);
}

.view-more-btn:active {
    transform: scale(0.96);
}
</style>
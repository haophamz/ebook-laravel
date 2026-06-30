<section class="section">

    <div class="section-head">
        <h2 class="section-title">
            Sách mới nhất
        </h2>

        <a href="{{ route('books.latest') }}" class="view-more-btn">
            Xem thêm
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
        </a>
    </div>

    <div class="book-grid">
        @forelse($latestBooks as $book)
            <a href="{{ route('home.watch', $book->slug) }}">
                <div class="book-card" style="position: relative;">

                    {{-- Badge hiển thị loại sách --}}
                    @if($book->access_type == 'vip' )
                        <div class="member-badge">
                            <img src="{{ asset('storage/img/hoivien.png') }}" alt="Hội viên">
                        </div>
                    @elseif($book->access_type == 'paid')
                        <div class="price-badge" style="position:absolute; top:10px; right:10px; background:#ff4081; color:#fff; padding:4px 8px; border-radius:4px; font-size:12px; font-weight:bold; z-index:10;">
                            {{ number_format($book->price) }} VND
                        </div>
                    @elseif($book->access_type == 'free')
                        <div class="free-badge" style="position:absolute; top:-5px; right:5px; z-index:10;">
                            <img src="{{ asset('storage/img/free.png') }}" alt="free" style="width:100px;">
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
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($book->description),120) }}</p>
                            <div class="overlay-actions"></div>
                        </div>
                    </div>

                    <div class="book-title">
                        {{ $book->title }}
                    </div>

                </div>
            </a>
        @empty
            <div class="empty-books">Chưa có sách mới nhất</div>
        @endforelse
    </div>

</section>
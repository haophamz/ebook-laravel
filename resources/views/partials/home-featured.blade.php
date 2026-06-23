
<section class="section">

    <h2 class="section-title">
        Ebook nổi bật
    </h2>

    <div class="book-grid">

        @forelse($featuredBooks as $book)
        <a href="{{ route('home.watch',$book->slug) }}" >


            <div class="book-card"> 

                @if($book->is_vip)

                    <div class="member-badge">

                        <img src="{{ asset('storage/img/hoivien.png') }}"
                             alt="Hội viên">

                    </div>

                @endif

                <div class="book-cover">

                    @if($book->cover)

                        <img src="{{ asset('storage/'.$book->cover) }}"
                             alt="{{ $book->title }}">

                    @else

                        <img src="https://placehold.co/400x600?text=No+Cover"
                             alt="No Cover">

                    @endif

                    <div class="book-overlay">

                        <h4>
                            {{ $book->title }}
                        </h4>

                        <p>
                            {{ \Illuminate\Support\Str::limit(strip_tags($book->description),120) }}
                        </p>

                        <div class="overlay-actions">


                        </div>

                    </div>

                </div>

                <div class="book-title">
                    {{ $book->title }}
                </div>

            </div>

        @empty

            <div class="empty-books">
                Chưa có ebook nổi bật
            </div>

        @endforelse

    </div>
    </a>

</section>


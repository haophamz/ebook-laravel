<section class="home-banner">

    <div class="swiper bannerSwiper">

        <div class="swiper-wrapper">

            @foreach($banners as $banner)

                <div class="swiper-slide">

                    <a href="{{ $banner->url ?: '#' }}"
                       target="_blank">

                        <img src="{{ asset('storage/'.$banner->image) }}"
                             alt="Banner">

                    </a>

                </div>

            @endforeach

        </div>

        <div class="swiper-pagination"></div>

        <div class="swiper-button-prev"></div>

        <div class="swiper-button-next"></div>

    </div>

</section>
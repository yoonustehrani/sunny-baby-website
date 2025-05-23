<div class="swiper-slide" lazy="true">
    <div class="wrap-slider">
        <img class="lazyload" data-src="{{ $img }}" src="{{ $img }}" alt="fashion-slideshow-01">
        <div class="box-content tw:pl-6 tw:md:pl-12 tw:flex tw:justify-end">
            <div class="tw:flex tw:flex-col tw:w-fit">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
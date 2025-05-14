<div class="swiper-slide" lazy="true">
    <div class="wrap-slider">
        <img class="lazyload" data-src="{{ $img }}" src="{{ $img }}" alt="fashion-slideshow-01">
        <div class="box-content tw:flex tw:justify-end">
            <div class="tw:flex tw:flex-col tw:px-12 tw:w-fit">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
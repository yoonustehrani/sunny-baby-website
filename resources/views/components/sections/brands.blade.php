@props(['brands'])
<section class="tw:flex tw:justify-center tw:mb-12">
    <div class="tw:bg-alabaster-dark tw:shadow-md tw:rounded-2xl tw:w-11/12 tw:lg:w-4/5 tw:py-8 tw:px-4">
        <div class="tw:w-fit tw:mx-auto">
            <div class="flat-title">
                <span class="title wow fadeInUp tw:font-bold" data-wow-delay="0s">دسته بندی بر اساس برند</span>
                <p class="sub-title wow fadeInUp" data-wow-delay="0s">بر اساس برند تولیدکنندگان مشهور، محصول مدنظرتان را
                    بیابید.</p>
            </div>
        </div>
        <div class="container" dir="ltr" x-data="{}">
            <div x-init='brandCarousel($el)' class="swiper tf-sw-brand tw:border-orange-900/10 tw:bg-white tw:shadow" data-loop="false" data-play="false" data-preview="6" data-tablet="3"
                data-mobile="2" data-space-lg="0" data-space-md="0">
                <div class="swiper-wrapper">
                    @foreach ($brands as $brand)
                        <div class="swiper-slide tw:aspect-square">
                            <div class="brand-item tw:border-orange-900/10 tw:h-full">
                                <a class="tw:flex tw:flex-col tw:items-center tw:justify-between tw:h-full tw:duration-300 tw:hover:text-primary" href="{{ route('pages.shop') }}">
                                    @if ($brand->image)
                                        <img class="lazyload" data-src="{{ asset($brand->image->url) }}" src="{{ asset($brand->image->thumbnail_url) }}"
                                        alt="image-brand">
                                    @endif
                                    <span class="tw:text-lg tw:font-bold">{{ $brand->name }}</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="sw-dots style-2 sw-pagination-brand justify-content-center"></div>
        </div>
    </div>
</section>
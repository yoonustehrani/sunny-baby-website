<!-- Product -->
<section class="flat-spacing-6 pt_0">
    <div class="container">
        <div class="flat-title wow fadeInUp" data-wow-delay="0s">
            <span class="title">{{ $title }}</span>
            <div class="d-flex gap-16 align-items-center">
                <div class="nav-sw-arrow nav-next-slider nav-next-product"><span class="icon icon-arrow1-right"></span></div>
                <a href="{{ $url ?? '#' }}" class="tf-btn btn-line fs-12 fw-6">@lang('VIEW ALL')</a>
                <div class="nav-sw-arrow nav-prev-slider nav-prev-product"><span class="icon icon-arrow1-left"></span></div>
            </div>   
        </div>
        <div class="hover-sw-nav hover-sw-2">
            <div class="swiper tf-sw-product-sell wrap-sw-over" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="15" data-pagination="2" data-pagination-md="3" data-pagination-lg="3">
                <div class="swiper-wrapper">
                    @foreach (\App\Models\Product::take(10)->get() as $product)
                        <div class="swiper-slide" lazy="true">
                            <x-cards.product-card :$product class="style-5 tw:bg-white! tw:p-2! tw:rounded-xl"/>
                        </div>
                    @endforeach
                </div>
            <div class="nav-sw nav-prev-slider nav-next-product box-icon w_46 round"><span class="icon icon-arrow-right"></span></div>
            <div class="nav-sw nav-next-slider nav-prev-product box-icon w_46 round"><span class="icon icon-arrow-left"></span></div>
        </div>
    </div>
</section>
<!-- /Product -->
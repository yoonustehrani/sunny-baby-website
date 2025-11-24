<div>
    <section>
        <div class="container flat-spacing-1 pt_0">
            <div class="flat-title">
                <span class="title">{{ $title }}</span>
            </div>
            <div class="hover-sw-nav hover-sw-2">
                <div 
                    x-init='productCarousel($el)'
                    class="swiper tf-sw-product-sell wrap-sw-over" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="15" data-pagination="2" data-pagination-md="3" data-pagination-lg="3">
                    <div class="swiper-wrapper">
                        @foreach ($products as $item)
                            <div class="swiper-slide" wire:key='pc-{{ md5($title) . '-' . $item->id }}' lazy="true">
                                <x-cards.product-card :product='$item'/>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="nav-sw nav-prev-slider nav-next-product box-icon w_46 round"><span class="icon icon-arrow-right"></span></div>
                <div class="nav-sw nav-next-slider nav-prev-product box-icon w_46 round"><span class="icon icon-arrow-left"></span></div>
                <div class="sw-dots style-2 sw-pagination-product justify-content-center"></div>
            </div>
        </div>
    </section>
</div>
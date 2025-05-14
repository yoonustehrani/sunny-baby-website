<!-- New Arrivals -->
<section class="flat-spacing-6">
    <div class="container">
        <div class="flat-title mb_1 gap-14">
            <span class="title wow fadeInUp" data-wow-delay="0s">جدیدترین محصولات</span>
            <p class="sub-title wow fadeInUp" data-wow-delay="0s">محصولات جدید آپدیت شده با آخرین پست های صفحه اینستاگرام ما</p>
        </div>
        <div class="grid-layout loadmore-item" data-grid="grid-4">
            @for ($i = 0; $i < 12; $i++)
                <x-cards.new-product title="محصول تستی جدید" :price="random_price()"/>
            @endfor
        </div>
        <div class="tf-pagination-wrap view-more-button text-center">
            <button class="tf-btn-loading tf-loading-default style-2 btn-loadmore "><span class="text">@lang('Load more')</span></button>
        </div>
    </div>
</section>
<!-- /New Arrivals -->
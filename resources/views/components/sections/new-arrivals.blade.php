<!-- New Arrivals -->
<section class="flat-spacing-6">
    <div class="container">
        <div class="flat-title mb_1 gap-14">
            <span class="title wow fadeInUp" data-wow-delay="0s">جدیدترین محصولات</span>
            <p class="sub-title wow fadeInUp" data-wow-delay="0s">محصولات جدید آپدیت شده با آخرین پست های صفحه اینستاگرام ما</p>
        </div>
        <div class="grid-layout loadmore-item" data-grid="grid-4">
            @foreach (\App\Models\Product::with('discount', 'variables.values')->take(12)->latest()->get() as $product)
                <x-cards.new-product :product="$product"/>
            @endforeach
        </div>
        <div class="tf-pagination-wrap view-more-button text-center">
            <button class="tf-btn-loading tf-loading-default style-2 btn-loadmore "><span class="text">@lang('Load more')</span></button>
        </div>
    </div>
</section>
<!-- /New Arrivals -->
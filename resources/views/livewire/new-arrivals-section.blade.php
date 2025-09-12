<div>
    <section class="flat-spacing-6">
        <div class="container" x-data="{loadMore: true}">
            <div class="flat-title mb_1 gap-14">
                <span class="title wow fadeInUp" data-wow-delay="0s">جدیدترین محصولات</span>
                <p class="sub-title wow fadeInUp" data-wow-delay="0s">محصولات جدید آپدیت شده با آخرین پست های صفحه اینستاگرام ما</p>
            </div>
            <div class="grid-layout" data-grid="grid-4">
                @foreach ($products as $product)
                    <x-cards.product-card 
                        wire:key='pr-new-{{ $product->id }}' 
                        :$product 
                        class="tw:bg-white! tw:p-2! tw:rounded-xl style-4 tw:flex-col"
                        x-bind:class="(!loadMore) {{ $loop->index < 4 ? ' || true' : '' }} ? 'tw:flex' : 'tw:hidden'"
                    />
                @endforeach
            </div>
            <div x-on:click="loadMore=false" x-show="loadMore" class="tf-pagination-wrap view-more-button text-center">
                <button class="tf-btn-loading tf-loading-default style-2 btn-loadmore"><span class="text">@lang('Load more')</span></button>
            </div>
        </div>
    </section>
</div>
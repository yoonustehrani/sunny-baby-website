<section class="tw:flex tw:justify-center tw:items-center tw:my-6">
    @php
        $cats = [
            'پوشاک نوزاد' => 'images/collections/clothes.webp',
            'غذاخوری نوزاد' => 'images/collections/feeding.webp',
            'کالای خواب نوزاد' => 'images/collections/sleeping.webp',
            'ملزومات سفر و گردش' => 'images/collections/travel.webp',
            'محصولات بهداشتی، مراقبتی، حمام' => 'images/collections/bathing.webp'
        ];
        $main_categories = \Cache::rememberForever('category-banners', fn() => \App\Models\Category::whereNull('parent_id')->limit(10)->get());
    @endphp
    <div class="tw:w-full tw:h-full tw:md:w-4/5 tw:overflow-hidden">
        <div class="masonry-layout tw:grid tw:grid-cols-2 tw:md:grid-cols-none tw:md:grid-flow-col tw:md:grid-rows-2 tw:md:h-[46rem]">
            @foreach ($cats as $name => $image)
                @unless ($loop->last)
                    <div class="collection-item hover-img wow fadeInUp" data-wow-delay=".1s">
                        <div class="collection-inner">
                            <a href="{{ route('categories.show', ['slug' => $main_categories->firstWhere('name', $name)?->slug]) }}" class="collection-image img-style rounded-0 tw:h-fit tw:aspect-square tw:md:h-full">
                                <img class="lazyload" data-src="{{ asset($image) }}" src="{{ asset($image) }}" alt="collection-img">
                            </a>
                            <div class="collection-content tw:w-full tw:flex tw:justify-center">
                                <a href="{{ route('categories.show', ['slug' => $main_categories->firstWhere('name', $name)?->slug]) }}" class="tf-btn collection-title hover-icon tw:bg-white/60 tw:hover:bg-black tw:hover:text-white"><span>{{ $name }}</span><i class="icon icon-arrow1-top-left"></i></a>
                            </div>
                        </div>
                    </div>
                @else
                <div class="tw:col-span-full tw:md:col-span-1 tw:md:row-span-full collection-item large hover-img wow fadeInUp" data-wow-delay="0s">
                    <div class="collection-inner">
                        <a href="{{ route('categories.show', ['slug' => $main_categories->firstWhere('name', $name)?->slug]) }}" class="collection-image img-style rounded-0 tw:h-fit tw:aspect-square tw:md:aspect-auto tw:md:h-full">
                            <img class="lazyload" data-src="{{ asset($image) }}" src="{{ asset($image) }}" alt="collection-img">
                        </a>
                        <div class="collection-content tw:w-full tw:flex tw:justify-center">
                            <a href="{{ route('categories.show', ['slug' => $main_categories->firstWhere('name', $name)?->slug]) }}" class="tf-btn collection-title hover-icon tw:bg-white/60 tw:hover:bg-black tw:hover:text-white"><span>{{ $name }}</span><i class="icon icon-arrow1-top-left"></i></a>
                        </div>
                    </div>
                </div>
                @endunless
            @endforeach
        </div>
    </div>
</section>
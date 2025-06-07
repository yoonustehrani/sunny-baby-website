<div class="swiper-slide" lazy="true">
    <div class="card-product style-5 tw:bg-white! tw:p-2! tw:rounded-xl">
        <div class="card-product-wrapper">
            <a href="product-detail.html" class="product-img">
                <img class="lazyload img-product" data-src="{{ asset('images/products/photo-1.jpg') }}" src="{{ asset('images/products/photo-1.jpg') }}" alt="image-product">
                <img class="lazyload img-hover" data-src="{{ asset('images/products/photo-2.jpg') }}" src="{{ asset('images/products/photo-2.jpg') }}" alt="image-product">
            </a>
            {{-- <x-product-item.buttons /> --}}
            <x-product-item.size-list />
        </div>
        <div class="card-product-info">
            <a href="#" class="title link tw:text-base tw:mx-auto tw:font-normal">{{ $title }}</a>
            <span class="price tw:text-sm tw:mx-auto tw:font-normal tw:text-caramel">{{ format_price($price) }}</span>
            <a class="tw:block tw:w-full tw:md:w-auto tw:text-sm tw:text-center tw:rounded-md tw:shadow-sm tw:border tw:border-transparent tw:duration-300 tw:hover:border-gray-700 tw:bg-dun tw:px-2 tw:lg:px-3 tw:py-1 tw:mb-3 tw:mt-1 tw:mx-auto" href="#">@lang('QUICK ADD')</a>
            {{-- <x-product-item.color-list :colors="[
                [
                    'name' => 'Orange',
                    'class' => 'bg_orange-3',
                    'img' => 'images/products/photo-1.jpg',
                    'thumbnail' => 'images/products/photo-1.jpg',
                ],
                [
                    'name' => 'Black',
                    'class' => 'bg_dark',
                    'img' => 'images/products/photo-2.jpg',
                    'thumbnail' => 'images/products/photo-2.jpg',
                ],
                [
                    'name' => 'White',
                    'class' => 'bg_white',
                    'img' => 'images/products/photo-3.jpg',
                    'thumbnail' => 'images/products/photo-3.jpg',
                ],
            ]"/> --}}
        </div>
    </div>
</div>
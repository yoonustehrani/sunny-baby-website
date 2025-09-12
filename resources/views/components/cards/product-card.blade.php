<div {{ $attributes->merge(['class' => 'card-product']) }}>
    <div class="card-product-wrapper">
        <a href="{{ route('products.show', ['slug' => $product->slug]) }}" class="product-img">
            @isset($product->images[0])
                <img class="lazyload img-product" data-src="{{ asset($product->images[0]->url) }}" src="{{ asset($product->images[0]->thumbnail_url) }}" alt="image-product">    
            @endisset
            @isset($product->images[1])
                <img class="lazyload img-hover" data-src="{{ asset($product->images[1]->url) }}" src="{{ asset($product->images[1]->thumbnail_url) }}" alt="image-product">
            @endisset
        </a>
        <div class="list-product-btn column-right">
            <a href="javascript:void(0);" class="box-icon wishlist bg_white round btn-icon-action">
                <span class="icon icon-heart"></span>
                <span class="tooltip">Add to Wishlist</span>
                <span class="icon icon-delete"></span>
            </a>
            <a href="home-04.html#compare" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft" class="box-icon compare bg_white round btn-icon-action">
                <span class="icon icon-compare"></span>
                <span class="tooltip">Add to Compare</span>
                <span class="icon icon-check"></span>
            </a>
            <a href="home-04.html#quick_view" data-bs-toggle="modal" class="box-icon quickview bg_white round tf-btn-loading">
                <span class="icon icon-view"></span>
                <span class="tooltip">Quick View</span>
            </a>
        </div>
        @if ($product->is_discounted)
            @unless(is_null($product->discount->expires_at))
            <div class="countdown-box">
                <div x-init='launchCountdown($el)' class="js-countdown" dir="rtl" data-timer="{{ $product->discount->expires_at->timestamp - now()->timestamp }}" data-labels="d :,h :,m"></div>
            </div>
            @endunless
            <div class="on-sale-wrap text-end">
                <div class="on-sale-item" dir="ltr">-{{ $product->discount_in_percent }}%</div>
            </div>
        @endif
        {{-- <x-product-item.size-list /> --}}
        <livewire:add-to-cart-button :$product style='hover'/>
    </div>
    <div class="card-product-info tw:px-2! tw:grow" x-data='{}'>
        <a href="{{ route('products.show', ['slug' => $product->slug]) }}" class="title link tw:text-sm tw:md:text-base tw:mx-auto tw:font-normal">{{ $product->title }}</a>
        <x-product-price :$product/>
        <livewire:add-to-cart-button :$product/>
        {{-- <ul class="list-color-product">
            <li class="list-color-item color-swatch active">
                <span class="tooltip">Grey</span>
                <span class="swatch-value bg_grey"></span>
                <img class="lazyload" data-src="{{ asset('images/products/photo-6.jpg') }}" src="{{ asset('images/products/photo-6.jpg') }}" alt="image-product">
            </li>
            <li class="list-color-item color-swatch">
                <span class="tooltip">Pink</span>
                <span class="swatch-value bg_pink"></span>
                <img class="lazyload" data-src="{{ asset('images/products/photo-8.jpg') }}" src="{{ asset('images/products/photo-8.jpg') }}" alt="image-product">
            </li>
            <li class="list-color-item color-swatch">
                <span class="tooltip">Light Pink</span>
                <span class="swatch-value bg_light-pink"></span>
                <img class="lazyload" data-src="{{ asset('images/products/photo-9.jpg') }}" src="{{ asset('images/products/photo-9.jpg') }}" alt="image-product">
            </li>
        </ul> --}}
    </div>
</div>
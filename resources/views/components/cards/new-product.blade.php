<div class="card-product tw:bg-alabaster! tw:p-2! tw:rounded-xl style-4 fl-item">
    <div class="card-product-wrapper">
        <a href="product-detail.html" class="product-img">
            <img class="lazyload img-product" data-src="{{ asset('images/products/photo-6.jpg') }}" src="{{ asset('images/products/photo-6.jpg') }}" alt="image-product">
            <img class="lazyload img-hover" data-src="{{ asset('images/products/photo-7.jpg') }}" src="{{ asset('images/products/photo-7.jpg') }}" alt="image-product">
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
        <div class="size-list">
            <span>S</span>
            <span>M</span>
            <span>L</span>
            <span>XL</span>
        </div>
        <a href="home-04.html#quick_add" data-bs-toggle="modal" class="btn-quick-add quick-add tw:hidden tw:md:flex">@lang('QUICK ADD')</a>
    </div>
    <div class="card-product-info tw:px-2!">
        <a href="#" class="title link tw:text-xl tw:mx-auto tw:font-semibold">{{ $title }}</a>
        <span class="price tw:text-lg tw:mx-auto tw:font-normal">{{ format_price($price) }}</span>
        <a class="tw:block tw:rounded-md tw:shadow-sm tw:border tw:border-transparent tw:duration-300 tw:hover:border-gray-700 tw:bg-sunset tw:px-3 tw:py-1 tw:my-4 tw:mx-auto" href="#">@lang('QUICK ADD')</a>
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
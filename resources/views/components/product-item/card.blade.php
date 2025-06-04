<div class="swiper-slide" lazy="true">
    <div class="card-product style-5">
        <div class="card-product-wrapper">
            <a href="product-detail.html" class="product-img">
                <img class="lazyload img-product" data-src="{{ asset('images/products/photo-1.jpg') }}" src="{{ asset('images/products/photo-1.jpg') }}" alt="image-product">
                <img class="lazyload img-hover" data-src="{{ asset('images/products/photo-2.jpg') }}" src="{{ asset('images/products/photo-2.jpg') }}" alt="image-product">
            </a>
            {{-- <x-product-item.buttons /> --}}
            <x-product-item.size-list />
        </div>
        <div class="card-product-info">
            <a href="product-detail.html" class="title link">{{ $title }}</a>
            <span class="price">{{ $price }}</span>
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
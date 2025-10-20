<li class="checkout-product-item">
    <figure class="img-product">
        @if ($product->main_image)
            <img src="{{ asset($product->main_image->thumbnail_url) }}" alt="product">
        @endif
        <span class="quantity">{{ $quantity }}</span>
    </figure>
    <div class="content">
        <div class="info">
            <p class="name">{{ $product->title }}</p>
            <div>
                @if ($product->is_discounted)
                <span class="price tw:line-through tw:text-gray-400">{{ format_price($product->price) }}</span>
                <br>
                <span class="price">{{ format_price($product->discounted_price) }}</span>
                @else
                <span class="price">{{ format_price($product->price) }}</span>
                @endif
            </div>
            {{-- <span class="variant">Brown / M</span> --}}
        </div>
        @if ($product->is_discounted)
            <div class="tw:flex tw:flex-col tw:grap-2 tw:items-end">
                <span class="price tw:font-bold">{{ format_price($product->discounted_price * $quantity) }}</span>
            </div>
        @else
        <span class="price tw:font-bold">{{ format_price($product->price * $quantity) }}</span>
        @endif
    </div>
</li>
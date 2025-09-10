<div class="tf-mini-cart-item">
    <div class="tf-mini-cart-image">
        <a href="product-detail.html">
            @isset($product->images[0])
                <img class="lazyload" data-src="{{ asset($product->images[0]->url) }}" src="{{ asset($product->images[0]->thumbnail_url) }}" alt="">
            @endisset
        </a>
    </div>
    <div class="tf-mini-cart-info">
        <a class="title link" href="product-detail.html">{{ $product->name }}</a>
        @foreach ($product->variables as $item)
            <div class="meta-variant">{{ $item->value }}</div>
        @endforeach
        @if ($product->is_discounted)
            <div class="tw:text-gray-400 tw:line-through fw-6">{{ format_price($product->price) }}</div>
            <div class="price fw-6">{{ format_price($product->discounted_price) }}</div>
        @else
            <div class="price fw-6">{{ format_price($product->price) }}</div>
        @endif
        <div class="tf-mini-cart-btns">
            <div class="wg-quantity small">
                <span class="btn-quantity minus-btn" wire:click='sub'>-</span>
                <input type="text" name="number" value="{{ $quantity }}">
                <span class="btn-quantity plus-btn" wire:click='add'>+</span>
            </div>
            <button class="tf-mini-cart-remove" wire:click='remove'>@lang('Remove')</button>
        </div>
    </div>
</div>
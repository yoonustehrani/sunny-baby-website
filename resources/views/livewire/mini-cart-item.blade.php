<div class="tf-mini-cart-item">
    @php
        $item = $product->parent_id ? $product->parent : $product;
    @endphp
    <div class="tf-mini-cart-image">
        <a href="{{ route('products.show', ['slug' => $item->slug]) }}">
            @isset($product->main_image)
                <img class="lazyload" data-src="{{ asset($product->main_image->url) }}" src="{{ asset($product->main_image->thumbnail_url) }}" alt="">
            @endisset
        </a>
    </div>
    <div class="tf-mini-cart-info">
        <a class="title link" href="{{ route('products.show', ['slug' => $item->slug]) }}">{{ $item->title }}</a>
        @if ($item->isVariable())
                <div class="meta-variant">{{ implode('، ', $product->attribute_options->map(fn($option) => $option->label)->toArray()) }}</div>
        @endif
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
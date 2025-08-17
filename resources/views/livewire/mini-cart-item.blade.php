<div class="tf-mini-cart-item">
    <div class="tf-mini-cart-image">
        <a href="product-detail.html">
            <img src="{{ asset('images/products/photo-4.jpg') }}" alt="">
        </a>
    </div>
    <div class="tf-mini-cart-info">
        <a class="title link" href="product-detail.html">{{ $product->name }}</a>
        @foreach ($product->variables as $item)
            <div class="meta-variant">{{ $item->value }}</div>
        @endforeach
        <div class="price fw-6">{{ format_price($product->price) }}</div>
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
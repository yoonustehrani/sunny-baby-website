@props(['product'])
<button type="button" @if($product) wire:click='addToCart({{ $product->getKey() }})' @endif {{ $attributes }} class="tw:disabled:text-gray-500 tw:disabled:bg-gray-300 tw:disabled:border-gray-300 tf-btn btn-fill tw:grow justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn">
    @isset($product)
        @if ($product->stock == 0)
            <span>@lang('Unavailable')</span>
        @elseif (!is_null($product->price))
            <span>@lang('Add to cart')</span>
            <span class="tf-qty-price">&nbsp;-&nbsp;{{ $product->is_discounted ? format_price($product->discounted_price) : format_price($product->price) }}</span>
        @endif
    @else
        <span>{{ "گزینه ها را انتخاب کنید." }}</span>
    @endisset
</button>
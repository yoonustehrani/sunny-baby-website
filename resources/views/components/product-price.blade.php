<div class="tw:flex tw:flex-col tw:gap-2">
@if ($product->is_discounted)
    <span class="price tw:text-sm tw:mx-auto tw:font-normal tw:text-gray-400 tw:line-through">{{ $product->price_label }}</span>
    <span class="price tw:text-sm tw:mx-auto tw:text-caramel tw:font-black">{{ format_price($product->discounted_price) }}</span>
@else
    <span class="price tw:text-sm tw:mx-auto tw:font-normal tw:text-caramel">{{ $product->price_label }}</span>
@endif
</div>
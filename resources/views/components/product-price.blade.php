<div class="tw:flex tw:flex-col tw:gap-2">
@if ($product->is_discounted)
    <span class="price tw:text-sm tw:mx-auto tw:font-normal tw:text-gray-400 tw:line-through">{{ format_price($product->price) }}</span>
    <span class="price tw:text-sm tw:mx-auto tw:text-caramel tw:font-black">{{ format_price($product->discounted_price) }}</span>
@else
    <span class="price tw:text-sm tw:mx-auto tw:font-normal tw:text-caramel">{{ format_price($product->price) }}</span>
@endif
</div>
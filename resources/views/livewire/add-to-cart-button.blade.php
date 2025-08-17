<div class="tw:w-full tw:flex tw:items-center tw:justify-center">
    @if ($inCart)
        <div class="tw:w-auto tw:bg-gray-100 tw:text-gray-800 tw:font-bold tw:flex tw:items-center tw:flex-row-reverse">
            <button type="button" wire:click='sub' class="tw:h-9 tw:w-9 tw:p-2 tw:grid tw:place-content-center tw:aspect-square">-</button>
            <div class="tw:max-h-full">
                <input type="text" class="tw:bg-gray-100 tw:text-gray-800 tw:h-6 tw:w-8 tw:text-center tw:p-0 tw:m-0" wire:model.blur='count'>
            </div>
            <button type="button" wire:click='add' class="tw:h-9 tw:w-9 tw:p-2 tw:grid tw:place-content-center tw:aspect-square">+</button>
        </div>
    @else
        <button 
            x-on:click="$dispatch('add-to-cart', {productId: '{{ $product->id }}'})"
            class="tw:block tw:w-full tw:md:w-auto tw:text-sm tw:text-center tw:rounded-md tw:shadow-sm tw:border tw:border-transparent tw:duration-300 tw:hover:border-gray-700 tw:bg-dun tw:px-2 tw:lg:px-3 tw:py-1 tw:mb-3 tw:mt-1 tw:mx-auto"
            >@lang('QUICK ADD')</button>
    @endif
</div>

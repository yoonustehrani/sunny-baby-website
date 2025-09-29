<div>
    @switch($style)
        @case("hover")
            @unless($inCart)
                <button type="button" wire:loading.attr="disabled" x-on:click="$dispatch('add-to-cart', {productId: '{{ $product->id }}'})"
                class="btn-quick-add quick-add tw:hidden tw:md:flex">{{ $product->stock < 1 ? __('Unavailable') : __('QUICK ADD') }}</a>
            @endunless
            @break
        @default
        <div class="tw:w-full tw:flex tw:items-center tw:justify-center">
            @if ($inCart)
            <div
                wire:loading.class.toggle='tw:text-gray-400'
                wire:loading.class.remove='tw:text-gray-800'
                class="tw:w-auto tw:bg-gray-100 tw:text-gray-800 tw:font-bold tw:flex tw:items-center tw:flex-row-reverse">
                <button type="button" wire:click='sub' wire:loading.attr="disabled"
                    class="tw:h-9 tw:w-9 tw:p-2 tw:grid tw:place-content-center tw:aspect-square">-</button>
                <div class="tw:max-h-full tw:flex tw:items-center tw:relative tw:justify-center tw:w-8">
                    <div wire:loading.delay.remove >
                        <input type="text"
                            class="tw:bg-gray-100 tw:outline-0 tw:text-gray-800 tw:h-6 tw:w-full tw:text-center tw:p-0 tw:m-0 tw:border-0"
                            wire:model.blur='count'
                            >
                    </div>
                    <div wire:loading.delay.short.class.remove='tw:opacity-0' class="tw:absolute tw:opacity-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z" opacity="0.25"/><path fill="currentColor" d="M10.72,19.9a8,8,0,0,1-6.5-9.79A7.77,7.77,0,0,1,10.4,4.16a8,8,0,0,1,9.49,6.52A1.54,1.54,0,0,0,21.38,12h.13a1.37,1.37,0,0,0,1.38-1.54,11,11,0,1,0-12.7,12.39A1.54,1.54,0,0,0,12,21.34h0A1.47,1.47,0,0,0,10.72,19.9Z"><animateTransform attributeName="transform" dur="0.75s" repeatCount="indefinite" type="rotate" values="0 12 12;360 12 12"/></path></svg>
                    </div>
                </div>
                <button type="button" wire:click='add' wire:loading.attr="disabled"
                    class="tw:h-9 tw:w-9 tw:p-2 tw:grid tw:place-content-center tw:aspect-square">+</button>
            </div>
            @else
            <button wire:loading.attr="disabled" x-on:click="$dispatch('add-to-cart', {productId: '{{ $product->id }}'})"
                class="tw:block tw:w-full tw:md:w-auto tw:text-sm tw:text-center tw:rounded-md tw:shadow-sm tw:border tw:border-transparent tw:duration-300 tw:hover:border-gray-700 tw:bg-dun tw:px-2 tw:lg:px-3 tw:py-1 tw:mb-3 tw:mt-1 tw:mx-auto"
            >{{ $product->stock < 1 ? __('Unavailable') : __('QUICK ADD') }}</button>
            @endif
        </div>
    @endswitch
</div>
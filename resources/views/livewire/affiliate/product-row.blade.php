<tr class="text-gray-800 dark:text-white/90" @if($product->isVariant()) x-bind:class="{ 'hidden': displayVariable != {{ $product->parent_id }} }" @endif>
    <td class="px-5 py-4 sm:px-6">
        <div class="flex items-center">
            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                {{ $index + 1 }}
            </p>
        </div>
    </td>
    <td class="px-5 py-4 sm:px-6">
        <div class="flex items-center">
            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                {{ $product->sku ?: 'تعریف نشده' }}
            </p>
        </div>
    </td>
    <td class="px-5 py-4 sm:px-6">
        <div class="flex items-center">
            <div class="flex items-center gap-3">
                @if ($product->main_image)
                    <div class="w-10 h-10 overflow-hidden rounded-md">
                        <img src="{{ asset($product->main_image->thumbnail_url) }}" alt="{{ $product->title ?? '' }}" />
                    </div>
                @endif
                <div>
                    @if ($product->isVariant())
                        <span
                        class="block font-medium text-theme-sm">
                            {{ $product->variant_title }}
                        </span>
                    @else
                    <span
                        class="block font-medium text-theme-sm">
                        @if ($product->title)
                            {{ $product->title }}
                        @endif
                    </span>
                    @endif
                    @if ($product->isVariable())
                        <span class="block text-gray-500 text-theme-xs dark:text-gray-400">
                            دارای {{ $product->variants->count() }} نوع محصول
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </td>
    <td class="px-5 py-4 sm:px-6">
        <span>{{ $product->affiliate_price ? format_price($product->affiliate_price) : '---' }}</span>
    </td>
    <td class="px-5 py-4 sm:px-6">
        <span>@if($product->available_stock < 1) @lang('Unavailable') @else {{ $product->available_stock }} عدد @endif</span>
    </td>
    <td class="px-5 py-4 sm:px-6">
        <div class="flex items-center">
            @if (! $product->isVariable())
                @if ($inCart)
                    <button
                        type="button"
                        wire:click='removeFromCart'
                        class="rounded-md ml-2 px-2 py-0.5 flex items-center gap-2 text-theme-xs font-medium text-error-700 dark:bg-error-500/15 dark:text-error-500 bg-error-50"
                        >
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                        </svg>
                        حذف
                    </button>
                @endif
                @if ($product->available_stock > 0)
                    @if ($inCart)
                        <div
                            wire:loading.class.toggle='text-gray-400'
                            wire:loading.class.remove='text-gray-800'
                            class="w-auto bg-gray-100 dark:bg-gray-800 rounded-md overflow-hidden text-gray-800 dark:text-gray-300 font-bold flex items-center flex-row-reverse">
                            <button type="button" wire:click='sub' wire:loading.attr="disabled"
                                class="size-5 p-2 grid place-content-center aspect-square">-</button>
                            <div class="max-h-full flex items-center relative justify-center w-8">
                                <div wire:loading.delay.remove >
                                    <p class="bg-gray-100 dark:bg-gray-800 outline-0 h-6 w-full text-center p-0 m-0 border-0">{{ $count }}</p>
                                </div>
                                <div wire:loading.delay.short.class.remove='opacity-0' class="absolute opacity-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z" opacity="0.25"/><path fill="currentColor" d="M10.72,19.9a8,8,0,0,1-6.5-9.79A7.77,7.77,0,0,1,10.4,4.16a8,8,0,0,1,9.49,6.52A1.54,1.54,0,0,0,21.38,12h.13a1.37,1.37,0,0,0,1.38-1.54,11,11,0,1,0-12.7,12.39A1.54,1.54,0,0,0,12,21.34h0A1.47,1.47,0,0,0,10.72,19.9Z"><animateTransform attributeName="transform" dur="0.75s" repeatCount="indefinite" type="rotate" values="0 12 12;360 12 12"/></path></svg>
                                </div>
                            </div>
                            <button type="button" wire:click='add' wire:loading.attr="disabled"
                                class="size-5 p-2 grid place-content-center aspect-square">+</button>
                        </div>
                    @else
                        <button
                            type="button"
                            wire:click='addToCart'
                            class="rounded-md bg-success-50 px-2 py-0.5 text-theme-xs font-medium text-success-700 dark:bg-success-500/15 dark:text-success-500">
                            @lang('Add to cart')
                        </button>
                    @endif
                @else
                    <span
                        class="rounded-md bg-red-50 px-2 py-0.5 text-theme-xs font-medium text-red-700 dark:bg-red-500/15 dark:text-red-500">
                        @lang('Unavailable')
                    </span>
                @endif
            @else
            <button
                type="button"
                x-on:click='displayVariable = displayVariable == {{ $product->getKey() }} ? null : {{ $product->getKey() }}'
                class="rounded-md px-2 py-0.5 text-theme-xs font-medium"
                :class="{'text-warning-700 dark:bg-warning-500/15 dark:text-warning-500 bg-warning-50': displayVariable != {{ $product->getKey() }}, 'text-gray-700 dark:bg-gray-500/15 dark:text-gray-500 bg-gray-50': displayVariable == {{ $product->getKey() }}}"
                x-text="displayVariable == {{ $product->getKey() }} ? '@lang('Hide')' : '@lang('View variants')'"
                ></button>
            @endif
        </div>
    </td>
</tr>
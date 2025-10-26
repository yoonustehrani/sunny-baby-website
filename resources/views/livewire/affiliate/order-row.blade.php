<tr class="text-gray-800 dark:text-white/90">
    <th class="px-5 py-4 sm:px-6 text-right">
        <span>{{ $index }}</span>
    </th>
    <td class="px-5 py-4 sm:px-6">
        <div class="flex items-center">
            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                <span class="block font-medium text-theme-sm">
                    {{ $product->isVariant() ? $product->parent->title : $product->title }}
                </span>
                @if ($product->isVariant())
                    <span class="block text-gray-500 text-theme-xs dark:text-gray-400">
                        {{ $product->variant_title }}
                    </span>
                @endif
            </p>
        </div>
    </td>
    <td class="px-5 py-4 sm:px-6">
        <span>{{ format_price($product->affiliate_price) }}</span>
    </td>
    <td class="px-5 py-4 sm:px-6">
        <span>{{ $count }}</span>
    </td>
    <td class="px-5 py-4 sm:px-6">
        <span>{{ format_price($product->affiliate_price * $count) }}</span>
    </td>
    <td class="px-5 py-4 sm:px-6">
        <div class="flex items-center">
            @if (! $product->isVariable())
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
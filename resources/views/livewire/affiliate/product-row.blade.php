<tr @if($product->isVariant()) x-bind:class="{ 'hidden': displayVariable != {{ $product->parent_id }} }" @endif>
    <td class="px-5 py-4 sm:px-6">
        <div class="flex items-center">
            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                #{{ $product->getKey() }}
            </p>
        </div>
    </td>
    <td class="px-5 py-4 sm:px-6">
        <div class="flex items-center">
            <div class="flex items-center gap-3">
                @if ($product->main_image)
                    <div class="w-10 h-10 overflow-hidden rounded-full">
                        <img src="{{ asset($product->main_image->thumbnail_url) }}" alt="{{ $product->title ?? '' }}" />
                    </div>
                @endif
                <div>
                    @if ($product->isVariant())
                        <span
                        class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                            {{ $product->variant_title }}
                        </span>
                    @else
                    <span
                        class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
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
        <span class="text-gray-200">@if($product->available_stock < 1) @lang('Unavailable') @else {{ $product->available_stock }} عدد @endif</span>
    </td>
    <td class="px-5 py-4 sm:px-6">
        <div class="flex items-center">
            @if (! $product->isVariable())
            <button
                class="rounded-md bg-success-50 px-2 py-0.5 text-theme-xs font-medium text-success-700 dark:bg-success-500/15 dark:text-success-500">
                @lang('Add to cart')
            </button>
            @else
            <button
                x-on:click='displayVariable = displayVariable == {{ $product->getKey() }} ? null : {{ $product->getKey() }}'
                class="rounded-md px-2 py-0.5 text-theme-xs font-medium"
                :class="{'text-warning-700 dark:bg-warning-500/15 dark:text-warning-500 bg-warning-50': displayVariable != {{ $product->getKey() }}, 'text-gray-700 dark:bg-gray-500/15 dark:text-gray-500 bg-gray-50': displayVariable == {{ $product->getKey() }}}"
                x-text="displayVariable == {{ $product->getKey() }} ? '@lang('Hide')' : '@lang('View variants')'"
                ></button>
            @endif
        </div>
    </td>
</tr>
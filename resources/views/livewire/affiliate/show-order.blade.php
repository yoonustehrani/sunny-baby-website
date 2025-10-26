<div class="space-y-5 sm:space-y-6 text-gray-800 dark:text-white/90">
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                سفارش شناسه #{{ $order->getKey() }}
            </h3>
        </div>
        <div class="px-5 space-y-2">
            <p>وضعیت: {{ $order->status->getTitleFa() }}</p>
            <p>مجموع: {{ format_price($order->total) }}</p>
            <p>مجموع پرداخت شده: {{ format_price($order->total_paid) }}</p>
        </div>
    </div>
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="px-5 py-4 sm:px-6 sm:py-5 flex flex-col gap-5 justify-between">
            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                آیتم های سفارش
            </h3>
            <div
                class="overflow-hidden w-full rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="max-w-full overflow-x-auto">
                    <table class="min-w-full">
                        <!-- table header start -->
                        <thead>
                            <tr class="border-b border-gray-100 bg-gray-200 dark:border-gray-800 dark:bg-gray-900">
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            @lang('Row')
                                        </p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            @lang('Product')
                                        </p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            @lang('Unit price')
                                        </p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            @lang('Quantity')
                                        </p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            @lang('Total')
                                        </p>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @foreach ($order->items as $item)
                                <tr class="text-gray-800 dark:text-white/90">
                                    <th class="px-5 py-4 sm:px-6 text-right">
                                        <span>{{ $loop->index + 1 }}</span>
                                    </th>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                <span class="block font-medium text-theme-sm">
                                                    {{ $item->product->isVariant() ? $item->product->parent->title : $item->product->title }}
                                                </span>
                                                @if ($item->product->isVariant())
                                                    <span class="block text-gray-500 text-theme-xs dark:text-gray-400">
                                                        {{ $item->product->variant_title }}
                                                    </span>
                                                @endif
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <span>{{ format_price($item->unit_price) }}</span>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <span>{{ $item->quantity }}</span>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <span>{{ format_price($item->unit_price * $item->quantity) }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
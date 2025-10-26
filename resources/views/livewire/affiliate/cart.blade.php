<div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
    <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
            {{ $cart->count() > 0 ? __('Cart') : __("Your cart is empty") }}
        </h3>
    </div>
    @if ($cart->count() > 0)
        <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
            <div
                class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
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
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            @lang('Actions')
                                        </p>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @foreach ($cart->all() as $item)
                                <livewire:affiliate.order-row :index="$loop->index + 1" :product="$item['product']" key='af-order-item-{{ $item["product"]->getKey() }}'>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6 flex items-center justify-center">
            <a class="py-2 px-4 text-blue-600 bg-blue-500/10 dark:text-blue-500 dark:bg-blue-900/30 rounded-md" href="{{ route('affiliate.orders.checkout') }}">ثبت سفارش</a>
        </div>
    @endif
</div>

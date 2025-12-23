<div class="space-y-5 sm:space-y-6">
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/3">
        <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                @lang('My Orders')
            </h3>
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                {{-- <form>
                    <div class="relative">
                    <span class="absolute -translate-y-1/2 pointer-events-none top-1/2 left-4">
                        <svg class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3.04199 9.37381C3.04199 5.87712 5.87735 3.04218 9.37533 3.04218C12.8733 3.04218 15.7087 5.87712 15.7087 9.37381C15.7087 12.8705 12.8733 15.7055 9.37533 15.7055C5.87735 15.7055 3.04199 12.8705 3.04199 9.37381ZM9.37533 1.54218C5.04926 1.54218 1.54199 5.04835 1.54199 9.37381C1.54199 13.6993 5.04926 17.2055 9.37533 17.2055C11.2676 17.2055 13.0032 16.5346 14.3572 15.4178L17.1773 18.2381C17.4702 18.531 17.945 18.5311 18.2379 18.2382C18.5308 17.9453 18.5309 17.4704 18.238 17.1775L15.4182 14.3575C16.5367 13.0035 17.2087 11.2671 17.2087 9.37381C17.2087 5.04835 13.7014 1.54218 9.37533 1.54218Z" fill=""></path>
                        </svg>
                    </span>
                    <input type="text" placeholder="@lang('Search')..." class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-10 w-full rounded-lg border border-gray-300 bg-transparent py-2.5 pr-4 pl-[42px] text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden xl:w-[300px] dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    </div>
                </form>
                <div>
                    <button class="text-theme-sm shadow-theme-xs inline-flex h-10 items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-2.5 font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                    <svg class="stroke-current fill-white dark:fill-gray-800" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.29004 5.90393H17.7067" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M17.7075 14.0961H2.29085" stroke="" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M12.0826 3.33331C13.5024 3.33331 14.6534 4.48431 14.6534 5.90414C14.6534 7.32398 13.5024 8.47498 12.0826 8.47498C10.6627 8.47498 9.51172 7.32398 9.51172 5.90415C9.51172 4.48432 10.6627 3.33331 12.0826 3.33331Z" fill="" stroke="" stroke-width="1.5"></path>
                        <path d="M7.91745 11.525C6.49762 11.525 5.34662 12.676 5.34662 14.0959C5.34661 15.5157 6.49762 16.6667 7.91745 16.6667C9.33728 16.6667 10.4883 15.5157 10.4883 14.0959C10.4883 12.676 9.33728 11.525 7.91745 11.525Z" fill="" stroke="" stroke-width="1.5"></path>
                    </svg>

                    @lang('Filter')
                    </button>
                </div> --}}
                <div class="flex items-center gap-3">
                    <span class="text-gray-500 dark:text-gray-400"> @lang('Show') </span>
                    <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                        <select
                            wire:model.live='perPage'
                            class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-9 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none py-2 pr-8 pl-3 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                            {{-- :class="isOptionSelected &amp;&amp; 'text-gray-500 dark:text-gray-400'" @click="isOptionSelected = true" --}}
                            >
                            <option value="10" class="text-gray-500 dark:bg-gray-900 dark:text-gray-400">
                                10
                            </option>
                            <option value="8" class="text-gray-500 dark:bg-gray-900 dark:text-gray-400">
                                8
                            </option>
                            <option value="5" class="text-gray-500 dark:bg-gray-900 dark:text-gray-400">
                                5
                            </option>
                        </select>
                        <span class="absolute top-1/2 right-2 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                            <svg class="stroke-current" width="16" height="16" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.8335 5.9165L8.00016 10.0832L12.1668 5.9165" stroke="" stroke-width="1.2"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </div>
                    <span class="text-gray-500 dark:text-gray-400"> @lang('entries') </span>
                </div>
            </div>
        </div>
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
                                            @lang('ID')
                                        </p>
                                    </div>
                                </th>
                                 <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            @lang('Status')
                                        </p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            @lang('Amount')
                                        </p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            روش پرداخت
                                        </p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            تاریخ پرداخت
                                        </p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            تاریخ ایجاد
                                        </p>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <!-- table header end -->
                        <!-- table body start -->
                        <tbody x-data='{displayVariable: null}' class="divide-y divide-gray-100 dark:divide-gray-800">
                            @foreach ($transactions as $transaction)
                                <tr class="text-gray-800 dark:text-white/90">
                                    <td class="px-5 py-4 sm:px-6">
                                        <span>{{ $loop->index + 1 }}</span>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <span>#{{ $transaction->id }}</span>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <span>{{ $transaction->status->getTitleFa() }}</span>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <span>{{ format_price($transaction->amount) }}</span>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6 flex flex-col justify-center gap-2">
                                        @php
                                            $method = $transaction->getMethod();
                                        @endphp
                                        @if ($method->getLogoUrl())
                                            <img class="w-20 h-auto" src="{{ asset($method->getLogoUrl()) }}" alt="">
                                        @endif
                                        <span>{{ $method->getName() }}</span>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        @if ($transaction->paid_at)
                                            <span>{{ jalali($transaction->paid_at) }}<br>{{ $transaction->paid_at->format('H:i:s') }}</span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        @if ($transaction->paid_at)
                                            <span>{{ jalali($transaction->created_at) }}<br>{{ $transaction->created_at->format('H:i:s') }}</span>
                                        @endif
                                    </td>
                                    {{-- 
                                    <td class="px-5 py-4 sm:px-6">
                                        <span>{{ format_price($order->total_paid) }}</span>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <span>{{ jalali($order->created_at) }}<br>{{ $order->created_at->format('H:i:s') }}</span>
                                    </td> --}}
                                    {{-- <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            @if ($order->is_pending)
                                                <a
                                                    href="{{ route('orders.pay', ['order' => $order->getKey(), 'gateway' => 'zp']) }}"
                                                    class="rounded-md ml-2 px-2 py-0.5 flex items-center gap-2 text-theme-xs font-medium text-success-700 dark:bg-success-500/15 dark:text-success-500 bg-success-50"
                                                    >
                                                    پرداخت
                                                </a>
                                            @endif
                                            <a
                                                href="{{ route('affiliate.orders.show', ['order' => $order->getKey()]) }}"
                                                class="rounded-md ml-2 px-2 py-0.5 flex items-center gap-2 text-theme-xs font-medium text-warning-700 dark:bg-warning-500/15 dark:text-warning-500 bg-warning-50"
                                                >
                                                مشاهده
                                            </a>
                                        </div>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $transactions->links('affiliate.pagination') }}
                </div>
            </div>
        </div>
    </div>
</div>
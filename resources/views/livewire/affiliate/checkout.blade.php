<div class="space-y-5 sm:space-y-6">
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                @lang("My Addresses")
            </h3>
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                <form>
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
                </div>
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
                                            @lang('Fullname')
                                        </p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            @lang('Province') / @lang('City')
                                        </p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            @lang('Phone Number')
                                        </p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            @lang('Address')
                                        </p>
                                    </div>
                                </th>
                                <th class="px-5 py-3 sm:px-6">
                                    <div class="flex items-center">
                                        <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                            @lang('Zip')
                                        </p>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <!-- table header end -->
                        <!-- table body start -->
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @foreach ($addresses as $address)
                                <tr class="text-gray-800 dark:text-white/90">
                                    <th class="px-5 py-4 sm:px-6 text-right">
                                        <span>{{ $loop->index }}</span>
                                    </th>
                                </tr>
                                <td class="px-5 py-4 sm:px-6">
                                    <span>{{ $address->fullname }}</span>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <span>{{ $address->city->province->name }} / {{ $address->city->name }}</span>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <span>{{ $address->phone_number }}</span>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <p>{{ $address->text }}</p>
                                </td>
                                <td class="px-5 py-4 sm:px-6">
                                    <p>{{ $address->zip }}</p>
                                </td>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($addresses->count() > 0)
                        {{ $addresses->links('affiliate.pagination') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                @lang('New Address')
            </h3>
        </div>
        <div class="gap-y-6 gap-x-3 grid grid-cols-1 md:grid-cols-2 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
            <!-- Elements -->
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    نام و نام خانوادگی <span class="text-red-500">*</span>
                </label>
                <x-error name="form.fullname" />
                <input type="text" name="fullname" wire:model.live.debounce.300ms='form.fullname'
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
            </div>
        
            <!-- Elements -->
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    شماره تلفن <span class="text-red-500">*</span>
                </label>
                <x-error name="form.phone_number" />
                <input type="text" placeholder="09XXXXXXXXX" name="phone_number" wire:model.live.debounce.300ms='form.phone_number'
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
            </div>
            <div>
                <livewire:affiliate.search-model-input required modelClass='\App\Models\Province' :value='$form->provinceId' name='province' :label='__("Province")'/>
                <x-error name='form.provinceId'/>
            </div>
            @if ($form->provinceId)
                <div>
                    <livewire:affiliate.search-model-input required where="province_id='{{ $form->provinceId }}'" modelClass='\App\Models\City' :value='$form->cityId' name='city' :label='__("City") . "/" . __("Town")'/>
                    <x-error name='form.cityId'/>
                </div>
            @else
                <div></div>
            @endif
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    @lang('Zip') (اختیاری)
                </label>
                <x-error name="form.zip" />
                <input type="text" placeholder="۱۰ رقمی" name="zip" wire:model.live.debounce.300ms='form.zip'
                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
            </div>
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                @lang('Address') <span class="text-red-500">*</span>
                </label>
                <x-error name="form.address" />
                <textarea placeholder="آدرس دقیق و کامل" wire:model.live.debounce.300ms='form.address' type="text" rows="3" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"></textarea>
            </div>
        </div>
    </div>
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="px-5 py-4 sm:px-6 sm:py-5 flex items-center justify-between">
            <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                @lang('Billing details')
            </h3>
        </div>
        <div class="gap-y-6 gap-x-3 grid grid-cols-1 md:grid-cols-2 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
            <div>
                @if($form->getAddressForShipment())
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    انتخاب شیوه ارسال محصول <span class="text-red-500">*</span>
                </label>
                <x-error name="form.carrier_class" />
                <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                    <select
                        wire:model.live.debounce.300ms='form.carrier_class'
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                        :class="isOptionSelected &amp;&amp; 'text-gray-800 dark:text-white/90'" @change="isOptionSelected = true">
                        <option value="" disabled class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                            انتخاب کنید
                        </option>
                        @php
                            $active_carriers = collect(\App\Facades\Shipping::carriers())
                                ->map(fn($x) => get_carrier($x, $form->getAddressForShipment()))
                                ->filter(fn($x) => $x->isActive())
                                ->keyBy(fn($x) => $x::class);
                        @endphp
                        @foreach ($active_carriers as $carrierClass => $carrier)
                        <option value='{{ $carrierClass }}'" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                            {{ $carrier->getName() }} - {{ $carrier->getPriceLabel() }}
                        </option>
                        @endforeach
                        {{-- 
                        <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                            Template
                        </option>
                        <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                            Development
                        </option> --}}
                    </select>
                    <span
                        class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                        <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </div>
                @endif
            </div>
            <div>
                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                    انتخاب درگاه پرداخت
                </label>
                <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                    <select
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                        :class="isOptionSelected &amp;&amp; 'text-gray-800 dark:text-white/90'" @change="isOptionSelected = true">
                        <option value="" selected disabled class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                            زرین پال
                        </option>
                    </select>
                    <span
                        class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-700 dark:text-gray-400">
                        <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
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
                        <!-- table header end -->
                        <!-- table body start -->
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @foreach (affiliate_cart()->all() as $item)
                                <tr class="text-gray-800 dark:text-white/90">
                                    <th class="px-5 py-4 sm:px-6 text-right">
                                        <span>{{ $loop->index + 1 }}</span>
                                    </th>
                                    <td class="px-5 py-4 sm:px-6">
                                        <div class="flex items-center">
                                            <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                <span class="block font-medium text-theme-sm">
                                                    {{ $item['product']->isVariant() ? $item['product']->parent->title : $item['product']->title }}
                                                </span>
                                                @if ($item['product']->isVariant())
                                                    <span class="block text-gray-500 text-theme-xs dark:text-gray-400">
                                                        {{ $item['product']->variant_title }}
                                                    </span>
                                                @endif
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <span>{{ format_price($item['product']->affiliate_price) }}</span>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <span>{{ $item['quantity'] }}</span>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <span>{{ format_price($item['product']->affiliate_price * $item['quantity']) }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($addresses->count() > 0)
                        {{ $addresses->links('affiliate.pagination') }}
                    @endif
                </div>
            </div>
        </div>
        <div class="p-5 border-t border-gray-100 dark:border-gray-800 dark:text-gray-200 sm:p-6">
            <div class="flex flex-col gap-3">
                <div>
                    <p class="font-bold text-xl">مجموع سبد : {{ format_price($cart_total) }}</p>
                </div>
                @if ($form->carrier_class)
                    <div>
                        <p class="font-bold text-xl">هزینه ارسال: {{ get_carrier($form->carrier_class, $form->getAddressForShipment())->getPriceLabel() }}</p>
                    </div>
                @endif
                <div>
                    <p class="font-bold text-xl">قابل پرداخت: {{ format_price($total) }}</p>
                </div>
            </div>
        </div>
        <div wire:click='submit' class="p-5 border-t border-gray-100 dark:border-gray-800 dark:text-gray-200 sm:p-6 flex flex-col gap-3 items-center justify-center">
            @if ($errors->any())                    
            @php
                $messages   = $errors->all();
                $first      = $messages[0] ?? null;
                $extraCount = count($messages) - 1;
                $summary    = $first
                    ? ($extraCount > 0
                        ? "$first ". __("and :number more errors", ['number' => $extraCount]) . "."
                        : $first)
                    : null;
            @endphp
                    <p class="text-red-500 pb-4 font-bold">{{ $summary }}</p>
            @endif
            <button type="button" class="py-2 px-4 text-blue-600 bg-blue-500/10 dark:text-blue-500 dark:bg-blue-900/30 rounded-md">نهایی سازی سفارش</button>
        </div>
    </div>
</div>
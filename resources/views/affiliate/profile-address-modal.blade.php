<div x-show="isProfileAddressModal" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
    <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]"></div>
    <div @click.outside="isProfileAddressModal = false"
        class="no-scrollbar relative flex w-full max-w-[700px] flex-col overflow-y-auto rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-11">
        <!-- close btn -->
        <button @click="isProfileAddressModal = false"
            class="transition-color absolute right-5 top-5 z-999 flex h-11 w-11 items-center justify-center rounded-full bg-gray-100 text-gray-400 hover:bg-gray-200 hover:text-gray-600 dark:bg-gray-700 dark:bg-white/[0.05] dark:text-gray-400 dark:hover:bg-white/[0.07] dark:hover:text-gray-300">
            <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M6.04289 16.5418C5.65237 16.9323 5.65237 17.5655 6.04289 17.956C6.43342 18.3465 7.06658 18.3465 7.45711 17.956L11.9987 13.4144L16.5408 17.9565C16.9313 18.347 17.5645 18.347 17.955 17.9565C18.3455 17.566 18.3455 16.9328 17.955 16.5423L13.4129 12.0002L17.955 7.45808C18.3455 7.06756 18.3455 6.43439 17.955 6.04387C17.5645 5.65335 16.9313 5.65335 16.5408 6.04387L11.9987 10.586L7.45711 6.04439C7.06658 5.65386 6.43342 5.65386 6.04289 6.04439C5.65237 6.43491 5.65237 7.06808 6.04289 7.4586L10.5845 12.0002L6.04289 16.5418Z"
                    fill="" />
            </svg>
        </button>

        <div class="px-2 pr-14 mb-8">
            <h4 class="text-2xl font-semibold text-gray-800 dark:text-white/90">
                @lang('Edit Address')
            </h4>
        </div>
        <form class="flex flex-col" wire:submit='updateAddress'>
            <div class="px-2 overflow-y-auto custom-scrollbar">
                <div class="grid grid-cols-1 gap-x-6 gap-y-5 lg:grid-cols-2">
                    <div>
                        <livewire:affiliate.search-model-input required modelClass='\App\Models\Province' :value='$addressForm->province_id' name='province' :label='__("Province")'/>
                        <x-error name='addressForm.province_id'/>
                    </div>
                    @if ($addressForm->province_id)
                        <div>
                            <livewire:affiliate.search-model-input required where="province_id='{{ $addressForm->province_id }}'" modelClass='\App\Models\City' :value='$addressForm->city_id' name='city' :label='__("City") . "/" . __("Town")'/>
                            <x-error name='addressForm.city_id'/>
                        </div>
                    @else
                        <div></div>
                    @endif
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            @lang('Zip') <span class="text-red-500">*</span>
                        </label>
                        <x-error name="addressForm.zip" />
                        <input type="text" wire:model.live.debounce.300ms='addressForm.zip'
                            class="dark:bg-dark-900 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" />
                    </div>

                    <div class="col-span-full">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        @lang('Address') <span class="text-red-500">*</span>
                        </label>
                        <x-error name="addressForm.address" />
                        <textarea placeholder="آدرس دقیق و کامل" wire:model.live.debounce.300ms='addressForm.address' type="text" rows="3" class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"></textarea>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3 mt-6 lg:justify-end">
                <div>
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
                        <p class="text-red-500 font-bold">{{ $summary }}</p>
                    @endif
                </div>
                <button @click="isProfileAddressModal = false" type="button"
                    class="flex w-full justify-center rounded-lg border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] sm:w-auto">
                    @lang('Close')
                </button>
                <button type="submit"
                    class="flex w-full justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 sm:w-auto">
                    @lang('Save Changes')
                </button>
            </div>
        </form>
    </div>
</div>
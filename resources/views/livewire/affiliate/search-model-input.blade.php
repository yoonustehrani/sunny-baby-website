<fieldset class="fieldset">
    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">{{ $label }}@if($required)<span class="text-red-600">*</span>@endif</label>
    <style>
        .top-100 {top: 100%}
        .bottom-100 {bottom: 100%}
        .max-h-select {
            max-height: 300px;
        }
    </style>
    <div class="flex flex-col items-center relative mt-1" x-data="{ open: false, toggle() { this.open = ! this.open } }">
        <div class="w-full" x-on:click.outside="open = false">
            <div class="flex dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
            {{-- <div class="my-2 bg-white p-1 flex border border-gray-200 rounded"> --}}
                <div class="relative grow">
                    <input placeholder="جستجو کنید" autocomplete="off" x-on:focus='open = true' wire:model.live.debounce.300ms='search' class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-r-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                    @if ($value)
                        <p class="absolute flex items-center rounded-r-lg bg-white dark:bg-gray-900 right-0 p-1 px-2 appearance-none outline-none text-gray-800 dark:text-gray-200 top-0 h-full w-full">
                            <span>{{ $option['name'] }}</span>
                        </p>
                    @endif
                </div>
                @if ($value)
                    <div>
                        <button wire:click='unselect' type="button" class="cursor-pointer w-6 h-full flex items-center text-gray-400 outline-none focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x w-4 h-4">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                @endif
                <div class="text-gray-300 w-8 py-1 pr-2 pl-1 border-r flex items-center border-gray-200 dark:border-gray-800">
                    <button x-on:click='toggle()' type="button" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                        <svg :class="open ? '' : 'rotate-180'" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up w-4 h-4">
                            <polyline points="18 15 12 9 6 15"></polyline>
                        </svg>  
                    </button>
                </div>
            </div>
        </div>
        <div x-show='open' class="absolute shadow top-100 z-40 w-full left-0 rounded max-h-select overflow-y-auto">
            <div class="flex flex-col w-full">
                @isset($results)
                    @foreach ($results as $item)
                        <div wire:key='item-{{ $item->getKey() }}' wire:click='select({{ $item->getKey() }})' class="cursor-pointer w-full border-gray-100 dark:border-gray-700 rounded-t border-b hover:bg-teal-100" style="">
                            <div 
                            @class(['flex w-full items-center p-2 pl-2 border-l-2 relative dark:text-gray-300', 
                            'border-transparent bg-white dark:bg-gray-800 hover:bg-teal-600 hover:text-teal-100 hover:border-teal-600' => $item->getKey() != $value,
                            'bg-teal-600 text-teal-100 border-teal-600 dark:border:gray-900' => $item->getKey() == $value
                            ])>
                                <div class="w-full items-center flex">
                                    <div class="mx-2 leading-6">{{ $item->{$mainKey} }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endisset
            </div>
        </div>
    </div>
</fieldset>
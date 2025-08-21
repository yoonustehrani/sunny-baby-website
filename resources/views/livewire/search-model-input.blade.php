<fieldset class="fieldset">
    <label>{{ $label }}@if($required)<span class="tw:text-red-600">*</span>@endif</label>
    <style>
        .top-100 {top: 100%}
        .bottom-100 {bottom: 100%}
        .max-h-select {
            max-height: 300px;
        }
    </style>
    <div class="tw:flex tw:flex-col tw:items-center tw:relative" x-data="{ open: false, toggle() { this.open = ! this.open } }">
        <div class="tw:w-full" x-on:click.outside="open = false">
            <div class="tw:my-2 tw:bg-white tw:p-1 tw:flex tw:border tw:border-gray-200 tw:rounded">
                <div class="tw:relative tw:grow">
                    <input placeholder="جستجو کنید" autocomplete="off" x-on:focus='open = true' wire:model.live.debounce.300ms='search' class="tw:p-1 tw:px-2 tw:appearance-none tw:outline-none tw:w-full tw:text-gray-800">
                    @if ($value)
                        <p class="tw:absolute tw:bg-white tw:right-0 tw:p-1 tw:px-2 tw:appearance-none tw:outline-none tw:text-gray-800 tw:top-0 tw:h-full tw:w-full">{{ $option['name'] }}</p>
                    @endif
                </div>
                @if ($value)
                    <div>
                        <button wire:click='unselect' type="button" class="tw:cursor-pointer tw:w-6 tw:h-full tw:flex tw:items-center tw:text-gray-400 tw:outline-none tw:focus:tw:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x tw:w-4 tw:h-4">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                @endif
                <div class="tw:text-gray-300 tw:w-8 tw:py-1 tw:pr-2 tw:pl-1 tw:border-r tw:flex tw:items-center tw:border-gray-200">
                    <button x-on:click='toggle()' type="button" class="tw:cursor-pointer tw:w-6 tw:h-6 tw:text-gray-600 tw:outline-none tw:focus:tw:outline-none">
                        <svg :class="open ? '' : 'tw:rotate-180'" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up tw:w-4 tw:h-4">
                            <polyline points="18 15 12 9 6 15"></polyline>
                        </svg>  
                    </button>
                </div>
            </div>
        </div>
        <div x-show='open' class="tw:absolute tw:shadow top-100 tw:z-40 tw:w-full tw:left-0 tw:rounded max-h-select tw:overflow-y-auto">
            <div class="tw:flex tw:flex-col tw:w-full">
                @isset($results)
                    @foreach ($results as $item)
                        <div wire:key='item-{{ $item->getKey() }}' wire:click='select({{ $item->getKey() }})' class="tw:cursor-pointer tw:w-full tw:border-gray-100 tw:rounded-t tw:border-b tw:hover:bg-teal-100" style="">
                            <div 
                            @class(['tw:flex tw:w-full tw:items-center tw:p-2 tw:pl-2 tw:border-l-2 tw:relative', 
                            'tw:border-transparent tw:bg-white tw:hover:bg-teal-600 tw:hover:text-teal-100 tw:hover:border-teal-600' => $item->getKey() != $value,
                            'tw:bg-teal-600 tw:text-teal-100 tw:border-teal-600' => $item->getKey() == $value
                            ])>
                                <div class="tw:w-full tw:items-center tw:flex">
                                    <div class="tw:mx-2 tw:leading-6">{{ $item->{$mainKey} }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endisset
            </div>
        </div>
    </div>
</fieldset>
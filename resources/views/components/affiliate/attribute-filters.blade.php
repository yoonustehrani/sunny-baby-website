<div class="mt-4">
    <div class="facet-title mb-3" data-bs-target="#attr-filter-{{ md5($attribute->label) }}" data-bs-toggle="collapse" aria-expanded="true"
        aria-controls="color">
        <span class="text-2xl font-bold">{{ $attribute->label }}</span>
        <span class="icon icon-arrow-up"></span>
    </div>
    @if ($attribute->options->count())
        <div id="attr-filter-{{ md5($attribute->label) }}" class="show">
            <ul class="space-y-3">
                @foreach ($attribute->options as $option)
                    <li class="p-2" x-data="{ checkboxToggle: {{ $this->isFilterSelected($attribute->id, $option->id) ? 'true' : 'false' }} }">
                        <label for="attr-op-{{ $option->id }}" class="flex gap-2 cursor-pointer items-center text-sm font-medium text-gray-700 select-none dark:text-gray-400">
                            <div class="relative">
                                <input @change="checkboxToggle = !checkboxToggle" wire:change.live='toggleFilter({{ $attribute->id }}, {{ $option->id }})' type="checkbox" name="{{ $attribute->id }}" class="sr-only" id="attr-op-{{ $option->id }}">
                                <div :class="checkboxToggle ? 'border-brand-500 bg-brand-500' : 'bg-transparent border-gray-300 dark:border-gray-700'" class="hover:border-brand-500 dark:hover:border-brand-500 mr-3 flex h-5 w-5 items-center justify-center rounded-md border-[1.25px] border-brand-500 bg-brand-500">
                                    <span :class="checkboxToggle ? '' : 'opacity-0'" class="">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.6666 3.5L5.24992 9.91667L2.33325 7" stroke="white" stroke-width="1.94437" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            @switch($attribute->option_content_type)
                                @case(App\Enums\OptionContentType::COLOR)
                                    {{-- <input wire:change.live='toggleFilter({{ $attribute->id }}, {{ $option->id }})' type="checkbox" name="{{ $attribute->id }}" id="attr-op-{{ $option->id }}"> --}}
                                    <div class="size-4 rounded-full" style="background-color: {{ $option->content }};"></div>
                                    @break
                                @case(App\Enums\OptionContentType::IMAGE)
                                    {{-- <input wire:change.live='toggleFilter({{ $attribute->id }}, {{ $option->id }})' type="checkbox" name="{{ $attribute->id }}" class="tf-check" id="attr-op-{{ $option->id }}"> --}}
                                    <img height="40" width="40" src="{{ asset($option->content) }}" alt="{{ $attribute->label }} - {{ $option->label }}">
                                    @break
                            @endswitch
                            <span @class(['text-primary' => $this->isFilterSelected($attribute->id, $option->id)])>{{ $option->label }}&nbsp;<span>({{ $counts[$option->id] }})</span></span>
                        </label>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@props(['level', 'category'])
<label 
    {{-- {{ $this->isFilterSelected($attribute->id, $option->id) ? 'true' : 'false' }} --}}
    x-data="{ checkboxToggle: {{ $this->isCategorySelected($category->id) ? 'true' : 'false' }}}"
    class="flex gap-2 cursor-pointer items-center text-sm font-medium text-gray-700 select-none dark:text-gray-400"
    for="cat-filter-{{ $category->id }}">
    @for ($i = 0; $i < $level; $i++)
        {{ "-" }}
    @endfor
    <div class="relative">
        <input type="checkbox"
            @change="checkboxToggle = !checkboxToggle"
            wire:model.live="cats"
            value="{{ $category->id }}"
            class="sr-only"
            id="cat-filter-{{ $category->id }}">
        {{-- <input @change="checkboxToggle = !checkboxToggle" wire:change.live='toggleFilter({{ $attribute->id }}, {{ $option->id }})' type="checkbox" name="{{ $attribute->id }}" class="sr-only" id="attr-op-{{ $option->id }}"> --}}
        <div :class="checkboxToggle ? 'border-brand-500 bg-brand-500' : 'bg-transparent border-gray-300 dark:border-gray-700'" class="hover:border-brand-500 dark:hover:border-brand-500 mr-3 flex h-5 w-5 items-center justify-center rounded-md border-[1.25px] border-brand-500 bg-brand-500">
            <span :class="checkboxToggle ? '' : 'opacity-0'" class="">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.6666 3.5L5.24992 9.91667L2.33325 7" stroke="white" stroke-width="1.94437" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </span>
        </div>
    </div>
    <span>{{ $category->name }} ({{ $category->results_count }})</span>
</label>

@if(!empty($category->children))
    <ul class="ml-4 border-l border-gray-300 pl-3">
        @foreach($category->children as $child)
            <li>
                <x-shop.category-filter-item :category='$child' :level="$level + 1"/>
            </li>
        @endforeach
    </ul>
@endif
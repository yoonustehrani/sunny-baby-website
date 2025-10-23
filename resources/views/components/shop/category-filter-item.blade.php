@props(['level', 'category'])
<label class="tw:flex tw:items-center tw:gap-2 tw:font-normal!" for="cat-filter-{{ $category->id }}">
    @for ($i = 0; $i < $level; $i++)
        {{ "-" }}
    @endfor
    <input type="checkbox"
           wire:model.live="cats"
           value="{{ $category->id }}"
           class="mr-2 rounded tf-check"
           id="cat-filter-{{ $category->id }}">
    {{ $category->name }} ({{ $category->results_count }})
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
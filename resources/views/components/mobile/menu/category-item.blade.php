<li class="nav-mb-item tw:border-b tw:border-gray-100 tw:flex tw:flex-wrap tw:justify-between tw:items-center {{ $category->childrenRecursive->isNotEmpty() ? 'has-children collapsed' : 'sub-nav-link' }}">
    <a class="tw:flex tw:items-center py-2" href="{{ route('categories.show', ['slug' => $category->slug]) }}" >
        <div class="tw:p-1 tw:rounded-full">
            @if ($category->image)
                <img class="tw:size-8" src="{{ asset($category->image->url) }}" alt="">
            @else
                @php
                    $colors = ["tw:bg-orange-300 tw:text-orange-600", "tw:bg-sky-300 tw:text-sky-600", "tw:bg-gray-300 tw:text-gray-600", "tw:bg-rose-300 tw:text-rose-600", "tw:bg-purple-300 tw:text-purple-600"];
                @endphp
                <div class="{{ "tw:rounded-full tw:text-xs tw:size-8 tw:flex tw:items-center tw:justify-center" . " " . $colors[random_int(0, count($colors) - 1)] }}">{{ get_initials($category->name) }}</div>
            @endif
        </div>
        <span>{{ $category->name }}</span>
    </a>
    @if($category->childrenRecursive->isNotEmpty())
        <span class="tw:text-3xl tw:p-2" x-data='{}' x-on:click='openSubMenu($el, "cate-{{ $category->id }}")'>+</span>
    @endif
    @if($category->childrenRecursive->isNotEmpty())
        <div id="cate-{{ $category->id }}" class="tw:w-full collapse list-cate">
            <ul class="sub-nav-menu {{ $level > 1 ? 'sub-menu-level-'.$level : '' }}">
                @foreach($category->childrenRecursive as $child)
                    @include('components.mobile.menu.category-item', ['category' => $child, 'level' => $level + 1])
                @endforeach
            </ul>
        </div>
    @endif
</li>
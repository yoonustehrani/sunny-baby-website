<li>
    <a href="{{ $url }}" @class(['menu-item group', $class ?? '', 'menu-item-active' => $current, 'menu-item-inactive' => !$current])
        @if (! empty($subitems))
            @click.prevent="selected = (selected === '{{ $route }}' ? '':'{{ $route }}')"
        @else
            wire:navigate
        @endif
        :class="(selected === '{{ $route }}') ? 'menu-item-active' : 'menu-item-inactive'">
        {{-- class="menu-item group" --}}
        <svg 
            @class(['menu-item-icon-active' => $current, 'menu-item-icon-inactive' => !$current])
            width="24" height="24" viewBox="0 0 24 24" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M8 2C8.41421 2 8.75 2.33579 8.75 2.75V3.75H15.25V2.75C15.25 2.33579 15.5858 2 16 2C16.4142 2 16.75 2.33579 16.75 2.75V3.75H18.5C19.7426 3.75 20.75 4.75736 20.75 6V9V19C20.75 20.2426 19.7426 21.25 18.5 21.25H5.5C4.25736 21.25 3.25 20.2426 3.25 19V9V6C3.25 4.75736 4.25736 3.75 5.5 3.75H7.25V2.75C7.25 2.33579 7.58579 2 8 2ZM8 5.25H5.5C5.08579 5.25 4.75 5.58579 4.75 6V8.25H19.25V6C19.25 5.58579 18.9142 5.25 18.5 5.25H16H8ZM19.25 9.75H4.75V19C4.75 19.4142 5.08579 19.75 5.5 19.75H18.5C18.9142 19.75 19.25 19.4142 19.25 19V9.75Z"
                fill="" />
        </svg>

        <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
            {{ $title }}
        </span>

        @if (count($subitems) > 0)
            <svg 
                class="absolute left-2.5 top-1/2 -translate-y-1/2 stroke-current"
                :class="[(selected === '{{ $route }}') ? 'menu-item-arrow-active' : 'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : '' ]"
                width="20" height="20" viewBox="0 0 20 20" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke="" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        @endif
    </a>

    @if (count($subitems))
        <div class="overflow-hidden transform translate"
            :class="(selected === '{{ $route }}') ? 'block' :'hidden'">
            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                @foreach ($subitems as $item)
                    <x-affiliate.menu-item :route='$item["route"]' :title='$item["title"]' class="menu-dropdown-item group"/>
                    {{-- <li>
                        <a href="form-elements.html" 
                            :class="page === 'formElements' ? 'menu-dropdown-item-active' : 'menu-dropdown-item-inactive'">
                            Form Elements
                        </a>
                    </li> --}}
                @endforeach
            </ul>
        </div>
    @endif
</li>
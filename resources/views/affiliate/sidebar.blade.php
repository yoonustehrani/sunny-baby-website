<aside :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : 'translate-x-full'"
    class="sidebar fixed right-0 top-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-l border-gray-200 bg-white px-5 dark:border-gray-800 dark:bg-gray-900 lg:static lg:translate-x-0">
    <div :class="sidebarToggle ? 'justify-center' : 'justify-between'"
        class="flex items-center gap-2 pt-8 sidebar-header pb-7">
        <a href="{{ route('affiliate.dashboard') }}">
            <span class="logo" :class="sidebarToggle ? 'hidden' : ''">
                <img class="h-20 dark:hidden" src="{{ asset('images/logo/sunny-baby-logo.webp') }}" alt="Logo" />
                <img class="h-20 hidden dark:block" src="{{ asset('images/logo/sunny-baby-logo.webp') }}" alt="Logo" />
            </span>
            <img class="logo-icon h-16 mt-16" :class="sidebarToggle ? 'lg:block' : 'hidden'"
                src="{{ asset('images/logo/sunny-baby-logo.webp') }}" alt="Logo" />
        </a>
    </div>
    <div class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar">
        <!-- Sidebar Menu -->
        <nav x-data="{selected: $persist('Dashboard')}">
            <!-- Menu Group -->
            <div>
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">
                        @lang('Main menu')
                    </span>

                    <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
                        class="mx-auto fill-current menu-group-icon" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                            fill="" />
                    </svg>
                </h3>

                <ul class="flex flex-col gap-4 mb-6">
                    @php
                        $menu = [
                            ['title' => __('Dashboard'), 'route' => 'dashboard'],
                            ['title' => __('Orders'), 'route' => 'orders.*', 'subitems' => [
                                ['title' => __('New Order'), 'route' => 'orders.create'],
                                ['title' => __('List of orders'), 'route' => 'orders.index'],
                            ]],
                            ['title' => __('Financials'), 'route' => 'financials']
                        ];
                    @endphp
                    @foreach ($menu as $item)
                        <x-affiliate.menu-item :title="$item['title']" :route="$item['route']" :subitems="$item['subitems'] ?? []"/>
                    @endforeach
                </ul>
            </div>
        </nav>
        <!-- Sidebar Menu -->
    </div>
</aside>
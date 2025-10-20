<x-layouts.livewire :$title>
    <section class="flat-spacing-11 tw:bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <ul class="my-account-nav">
                        @foreach ([
                                'dashboard' => __('Dashboard'),
                                'orders' => __('My Orders'),
                                'addresses' => __('My Addresses'),
                                // 'details' => __('Account Details'),
                                // 'wishlist' => __('Wishlist'),
                        ] as $subroute => $text)
                            <x-user-account-menu-item :$text :$subroute/>
                        @endforeach
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" form="logout-form" href="login.html" class="my-account-nav-item">@lang('Logout')</button>
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-9">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </section>
</x-layouts.livewire>
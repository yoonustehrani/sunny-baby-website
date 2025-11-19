<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? config('app.name') }}</title>
    {{-- font --}}
    {{-- <link rel="stylesheet" href="fonts/fonts.css">
     --}}
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('fonts/font-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">
    @vite(['resources/css/app.css', 'resources/css/theme.css'])
    {{-- Favicon and Touch Icons --}}
    <link rel="shortcut icon" href="{{ asset('images/logo/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/logo/favicon.png') }}">
    {{ $head ?? '' }}
</head>
<body class="preload-wrapper popup-loader tw:font-yekan tw:font-base tw:w-screen tw:overflow-x-hidden tw:bg-isabelline" dir="rtl">
    <!-- preload -->
    <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- /preload -->
    <main id="wrapper" class="tw:w-full tw:overflow-x-hidden">
        {{ $slot }}
        <x-footer />
    </main>
    <!-- gotop -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 286.138;"></path>
        </svg>
    </div>
    <!-- /gotop -->
    
    <!-- toolbar-bottom -->
    <div class="tf-toolbar-bottom type-1150">
        <div class="toolbar-item">
            <a href="index.html#toolbarShopmb" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft">
                <div class="toolbar-icon">
                    <i class="icon-shop"></i>
                </div>
                <div class="toolbar-label">@lang('Categories')</div>
            </a>
        </div>
        
        <div class="toolbar-item">
            <a href="index.html#canvasSearch" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft">
                <div class="toolbar-icon">
                    <i class="icon-search"></i>
                </div>
                <div class="toolbar-label">@lang('Search')</div>
            </a>
        </div>
        <x-toolbar-item route="user-account.dashboard">
            <div x-data="{ loggedIn: @json(auth()->check()) }"
            x-on:user-logged-in.window="loggedIn = true;"
            x-on:user-logged-out.window="loggedIn = false">
                <a href="{{ route('user-account.dashboard') }}" x-show="loggedIn" x-cloak>
                    <div class="toolbar-icon">
                        <i class="icon-account"></i>
                    </div>
                    <div class="toolbar-label">@lang('Account')</div>
                </a>
                {{-- Visible when guest --}}
                <a href="#" x-show="!loggedIn" 
                    type="button"
                    class="nav-icon-item" 
                    data-bs-toggle="modal" 
                    data-bs-target="#login"
                    {{-- x-on:semi-protected-route.window='$el.click()' --}}
                    >
                    <div class="toolbar-icon">
                        <i class="icon-account"></i>
                    </div>
                    <div class="toolbar-label">@lang('Account')</div>
                </a>
            </div>
        </x-toolbar-item>
        {{-- <div class="toolbar-item">
            <a href="wishlist.html">
                <div class="toolbar-icon">
                    <i class="icon-heart"></i>
                    <div class="toolbar-count">0</div>
                </div>
                <div class="toolbar-label">@lang('Wishlist')</div>
            </a>
        </div> --}}
        <x-toolbar-item route="cart">
            <livewire:cart-icon mobile>
        </x-toolbar-item>
    </div>
    <!-- /toolbar-bottom -->

    <!-- modalDemo -->
    <div class="modal fade modalDemo" id="modalDemo">
        
    </div>
    <!-- /modalDemo -->    

    <!-- mobile menu -->
    <div class="offcanvas offcanvas-start canvas-mb" id="mobileMenu">
        <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
        <div class="mb-canvas-content">
            <div class="mb-body">
                <ul class="nav-ul-mb" id="wrapper-menu-navigation">
                    <li class="nav-mb-item">
                        <a href="index.html#dropdown-menu-one" class="collapsed mb-menu-link current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="dropdown-menu-one">
                            <span>Home</span>
                            <span class="btn-open-sub"></span>
                        </a>
                        <div id="dropdown-menu-one" class="collapse">
                            <ul class="sub-nav-menu" >
                                <li><a href="index.html" class="sub-nav-link">Home Fashion 01</a></li>
                                <li><a href="home-02.html" class="sub-nav-link">Home Fashion 02</a></li>
                                <li><a href="home-03.html" class="sub-nav-link">Home Fashion 03</a></li>
                                <li><a href="home-04.html" class="sub-nav-link">Home Fashion 04</a></li>
                                <li><a href="home-05.html" class="sub-nav-link">Home Fashion 05</a></li>
                                <li><a href="home-06.html" class="sub-nav-link">Home Fashion 06</a></li>
                                <li><a href="home-07.html" class="sub-nav-link">Home Fashion 07</a></li>
                                <li><a href="home-08.html" class="sub-nav-link">Home Fashion 08</a></li>
                                <li><a href="home-giftcard.html" class="sub-nav-link">Home Gift Card</a></li>
                                <li><a href="home-headphone.html" class="sub-nav-link">Home Headphone</a></li>
                                <li><a href="home-multi-brand.html" class="sub-nav-link">Home Multi Brand</a></li>
                                <li><a href="home-skincare.html" class="sub-nav-link">Home skincare</a></li>
                                <li><a href="home-headphone.html" class="sub-nav-link">Home Headphone</a></li>
                                <li><a href="home-giftcard.html" class="sub-nav-link">Home Gift Card</a></li>
                                <li><a href="home-furniture.html" class="sub-nav-link">Home Furniture</a></li>
                                <li><a href="home-furniture-02.html" class="sub-nav-link">Home Furniture 2</a></li>
                                <li><a href="home-skateboard.html" class="sub-nav-link">Home Skateboard</a></li>
                                <li><a href="home-stroller.html" class="sub-nav-link">Home Stroller</a></li>
                                <li><a href="home-decor.html" class="sub-nav-link">Home Decor</a></li>
                                <li><a href="home-electronic.html" class="sub-nav-link">Home Electronic</a></li>
                                <li><a href="home-setup-gear.html" class="sub-nav-link">Home Setup Gear</a></li>
                                <li><a href="home-dog-accessories.html" class="sub-nav-link">Home Dog Accessories</a></li>
                                <li><a href="home-kitchen-wear.html" class="sub-nav-link">Home Kitchen Wear</a></li>
                                <li><a href="home-phonecase.html" class="sub-nav-link">Home Phonecase</a></li>
                                <li><a href="home-paddle-boards.html" class="sub-nav-link">Home Paddle Boards</a></li>
                                <li><a href="home-glasses.html" class="sub-nav-link">Home Glasses</a></li>
                                <li><a href="home-pod-store.html" class="sub-nav-link">Home POD Store</a></li>
                                <li><a href="home-activewear.html" class="sub-nav-link">Home Activewear</a></li>
                                <li><a href="home-handbag.html" class="sub-nav-link">Home Handbag</a></li>
                                <li><a href="home-tee.html" class="sub-nav-link">Home Tee</a></li>
                                <li><a href="home-sock.html" class="sub-nav-link">Home Sock</a></li>
                                <li><a href="home-jewerly.html" class="sub-nav-link">Home Jewelry</a></li>
                                <li><a href="home-sneaker.html" class="sub-nav-link">Home Sneaker</a></li>
                            </ul>
                        </div>
                        
                    </li>
                    <li class="nav-mb-item">
                        <a href="index.html#dropdown-menu-two" class="collapsed mb-menu-link current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="dropdown-menu-two">
                            <span>Shop</span>
                            <span class="btn-open-sub"></span>
                        </a>
                        <div id="dropdown-menu-two" class="collapse">
                            <ul class="sub-nav-menu" id="sub-menu-navigation">
                                <li><a href="index.html#sub-shop-one" class="sub-nav-link collapsed"  data-bs-toggle="collapse" aria-expanded="true" aria-controls="sub-shop-one">
                                        <span>Shop layouts</span>
                                        <span class="btn-open-sub"></span>
                                    </a>
                                    <div id="sub-shop-one" class="collapse">
                                        <ul class="sub-nav-menu sub-menu-level-2">
                                            <li><a href="shop-default.html" class="sub-nav-link">Default</a></li>
                                            <li><a href="shop-left-sidebar.html" class="sub-nav-link">Left sidebar</a></li>
                                            <li><a href="shop-right-sidebar.html" class="sub-nav-link">Right sidebar</a></li>
                                            <li><a href="shop-fullwidth.html" class="sub-nav-link">Fullwidth</a></li>
                                            <li><a href="shop-collection-sub.html" class="sub-nav-link">Sub collection</a></li>
                                            <li><a href="shop-collection-list.html" class="sub-nav-link">Collections list</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="index.html#sub-shop-two" class="sub-nav-link collapsed"  data-bs-toggle="collapse" aria-expanded="true" aria-controls="sub-shop-two">
                                        <span>Features</span>
                                        <span class="btn-open-sub"></span>
                                    </a>
                                    <div id="sub-shop-two" class="collapse">
                                        <ul class="sub-nav-menu sub-menu-level-2">
                                            <li><a href="shop-link.html" class="sub-nav-link">Pagination links</a></li>
                                            <li><a href="shop-loadmore.html" class="sub-nav-link">Pagination loadmore</a></li>
                                            <li><a href="shop-infinite-scrolling.html" class="sub-nav-link">Pagination infinite scrolling</a></li>
                                            <li><a href="shop-filter-sidebar.html" class="sub-nav-link">Filter sidebar</a></li>
                                            <li><a href="shop-filter-hidden.html" class="sub-nav-link">Filter hidden</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="index.html#sub-shop-three" class="sub-nav-link collapsed"  data-bs-toggle="collapse" aria-expanded="true" aria-controls="sub-shop-three">
                                        <span>Product styles</span>
                                        <span class="btn-open-sub"></span>
                                    </a>
                                    <div id="sub-shop-three" class="collapse">
                                        <ul class="sub-nav-menu sub-menu-level-2">
                                            <li><a href="product-style-list.html" class="sub-nav-link">Product style list</a></li>
                                            <li><a href="product-style-01.html" class="sub-nav-link">Product style 01</a></li>
                                            <li><a href="product-style-02.html" class="sub-nav-link">Product style 02</a></li>
                                            <li><a href="product-style-03.html" class="sub-nav-link">Product style 03</a></li>
                                            <li><a href="product-style-04.html" class="sub-nav-link">Product style 04</a></li>
                                            <li><a href="product-style-05.html" class="sub-nav-link">Product style 05</a></li>
                                            <li><a href="product-style-06.html" class="sub-nav-link">Product style 06</a></li>
                                            <li><a href="product-style-07.html" class="sub-nav-link">Product style 07</a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-mb-item">
                        <a href="index.html#dropdown-menu-three" class="collapsed mb-menu-link current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="dropdown-menu-three">
                            <span>Products</span>
                            <span class="btn-open-sub"></span>
                        </a>
                        <div id="dropdown-menu-three" class="collapse">
                            <ul class="sub-nav-menu" id="sub-menu-navigation">
                                <li>
                                    <a href="index.html#sub-product-one" class="sub-nav-link collapsed"  data-bs-toggle="collapse" aria-expanded="true" aria-controls="sub-product-one">
                                        <span>Product layouts</span>
                                        <span class="btn-open-sub"></span>
                                    </a>
                                    <div id="sub-product-one" class="collapse">
                                        <ul class="sub-nav-menu sub-menu-level-2">
                                            <li><a href="product-detail.html" class="sub-nav-link">Product default</a></li>
                                            <li><a href="product-grid-1.html" class="sub-nav-link">Product grid 1</a></li>
                                            <li><a href="product-grid-2.html" class="sub-nav-link">Product grid 2</a></li>
                                            <li><a href="product-stacked.html" class="sub-nav-link">Product stacked</a></li>
                                            <li><a href="product-right-thumbnails.html" class="sub-nav-link">Product right thumbnails</a></li>
                                            <li><a href="product-bottom-thumbnails.html" class="sub-nav-link">Product bottom thumbnails</a></li>
                                            <li><a href="product-drawer-sidebar.html" class="sub-nav-link">Product drawer sidebar</a></li>
                                            <li><a href="product-description-accordion.html" class="sub-nav-link">Product description accordion</a></li>
                                            <li><a href="product-description-list.html" class="sub-nav-link">Product description list</a></li>
                                            <li><a href="product-description-vertical.html" class="sub-nav-link">Product description vertical</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="index.html#sub-product-two" class="sub-nav-link collapsed"  data-bs-toggle="collapse" aria-expanded="true" aria-controls="sub-product-two">
                                        <span>Product details</span>
                                        <span class="btn-open-sub"></span>
                                    </a>
                                    <div id="sub-product-two" class="collapse">
                                        <ul class="sub-nav-menu sub-menu-level-2">
                                            <li><a href="product-inner-zoom.html" class="sub-nav-link">Product inner zoom</a></li>
                                            <li><a href="product-zoom-magnifier.html" class="sub-nav-link">Product zoom magnifier</a></li>
                                            <li><a href="product-no-zoom.html" class="sub-nav-link">Product no zoom</a></li>
                                            <li><a href="product-photoswipe-popup.html" class="sub-nav-link">Product photoswipe popup</a></li>
                                            <li><a href="product-zoom-popup.html" class="sub-nav-link">Product external zoom and photoswipe popup</a></li>
                                            <li><a href="product-video.html" class="sub-nav-link">Product video</a></li>
                                            <li><a href="product-3d.html" class="sub-nav-link">Product 3D, AR models</a></li>
                                            <li><a href="product-options-customizer.html" class="sub-nav-link">Product options & customizer</a></li>
                                            <li><a href="product-advanced-types.html" class="sub-nav-link">Advanced product types</a></li>
                                            <li><a href="product-giftcard.html" class="sub-nav-link">Recipient information form for gift card products</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="index.html#sub-product-three" class="sub-nav-link collapsed"  data-bs-toggle="collapse" aria-expanded="true" aria-controls="sub-product-three">
                                        <span>Product swatchs</span>
                                        <span class="btn-open-sub"></span>
                                    </a>
                                    <div id="sub-product-three" class="collapse">
                                        <ul class="sub-nav-menu sub-menu-level-2">
                                            <li><a href="product-color-swatch.html" class="sub-nav-link">Product color swatch</a></li>
                                            <li><a href="product-rectangle.html" class="sub-nav-link">Product rectangle</a></li>
                                            <li><a href="product-rectangle-color.html" class="sub-nav-link">Product rectangle color</a></li>
                                            <li><a href="product-swatch-image.html" class="sub-nav-link">Product swatch image</a></li>
                                            <li><a href="product-swatch-image-rounded.html" class="sub-nav-link">Product swatch image rounded</a></li>
                                            <li><a href="product-swatch-dropdown.html" class="sub-nav-link">Product swatch dropdown</a></li>
                                            <li><a href="product-swatch-dropdown-color.html" class="sub-nav-link">Product swatch dropdown color</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="index.html#sub-product-four" class="sub-nav-link collapsed"  data-bs-toggle="collapse" aria-expanded="true" aria-controls="sub-product-four">
                                        <span>Product features</span>
                                        <span class="btn-open-sub"></span>
                                    </a>
                                    <div id="sub-product-four" class="collapse">
                                        <ul class="sub-nav-menu sub-menu-level-2">
                                            <li><a href="product-frequently-bought-together.html" class="sub-nav-link">Frequently bought together</a></li>
                                            <li><a href="product-frequently-bought-together-2.html" class="sub-nav-link">Frequently bought together 2</a></li>
                                            <li><a href="product-upsell-features.html" class="sub-nav-link">Product upsell features</a></li>
                                            <li><a href="product-pre-orders.html" class="sub-nav-link">Product pre-orders</a></li>
                                            <li><a href="product-notification.html" class="sub-nav-link">Back in stock notification</a></li>
                                            <li><a href="product-pickup.html" class="sub-nav-link">Product pickup</a></li>
                                            <li><a href="product-images-grouped.html" class="sub-nav-link">Variant images grouped</a></li>
                                            <li><a href="product-complimentary.html" class="sub-nav-link">Complimentary products</a></li>
                                            <li><a href="product-quick-order-list.html" class="sub-nav-link line-clamp">Quick order list<div class="demo-label"><span class="demo-new">New</span></div></a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-mb-item">
                        <a href="index.html#dropdown-menu-four" class="collapsed mb-menu-link current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="dropdown-menu-four">
                            <span>Pages</span>
                            <span class="btn-open-sub"></span>
                        </a>
                        <div id="dropdown-menu-four" class="collapse">
                            <ul class="sub-nav-menu" id="sub-menu-navigation">
                                <li><a href="about-us.html" class="sub-nav-link">About us</a></li>
                                <li><a href="brands.html" class="sub-nav-link line-clamp">Brands<div class="demo-label"><span class="demo-new">New</span></div></a></li>
                                <li><a href="brands-v2.html" class="sub-nav-link">Brands V2</a></li>
                                <li><a href="contact-1.html" class="sub-nav-link">Contact 1</a></li>
                                <li><a href="contact-2.html" class="sub-nav-link">Contact 2</a></li>
                                <li><a href="faq-1.html" class="sub-nav-link">FAQ 01</a></li>
                                <li><a href="faq-2.html" class="sub-nav-link">FAQ 02</a></li>
                                <li><a href="our-store.html" class="sub-nav-link">Our store</a></li>
                                <li><a href="store-locations.html" class="sub-nav-link">Store locator</a></li>
                                <li><a href="timeline.html" class="sub-nav-link line-clamp">Timeline<div class="demo-label"><span class="demo-new">New</span></div></a></li>
                                <li><a href="{{ route('cart') }}" class="sub-nav-link line-clamp">@lang("View cart")</a></li>
                                <li><a href="checkout.html" class="sub-nav-link line-clamp">Check out</a></li>
                                <li><a href="payment-confirmation.html" class="sub-nav-link line-clamp">Payment Confirmation</a></li>
                                <li><a href="payment-failure.html" class="sub-nav-link line-clamp">Payment Failure</a></li>
                                <li><a href="my-account.html" class="sub-nav-link line-clamp">My Account</a></li>
                            </ul>
                        </div>
                        
                    </li>
                    <li class="nav-mb-item">
                        <a href="index.html#dropdown-menu-five" class="collapsed mb-menu-link current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="dropdown-menu-five">
                            <span>Blog</span>
                            <span class="btn-open-sub"></span>
                        </a>
                        <div id="dropdown-menu-five" class="collapse">
                            <ul class="sub-nav-menu" >
                                <li><a href="blog-grid.html" class="sub-nav-link">Grid layout</a></li>
                                <li><a href="blog-sidebar-left.html" class="sub-nav-link">Left sidebar</a></li>
                                <li><a href="blog-sidebar-right.html" class="sub-nav-link">Right sidebar</a></li>
                                <li><a href="blog-list.html" class="sub-nav-link">Blog list</a></li>
                                <li><a href="blog-detail.html" class="sub-nav-link">Single Post</a></li>
                            </ul>
                        </div>
                        
                    </li>
                    <li class="nav-mb-item">
                        <a href="https://themeforest.net/item/ecomus-ultimate-html5-template/53417990?s_rank=3" class="mb-menu-link">Buy now</a>
                    </li>
                </ul>
                <div class="mb-other-content">
                    <div class="d-flex group-icon">
                        <a href="wishlist.html" class="site-nav-icon"><i class="icon icon-heart"></i>Wishlist</a>
                        <a href="home-search.html" class="site-nav-icon"><i class="icon icon-search"></i>Search</a>
                    </div>
                    <div class="mb-notice">
                        <a href="contact-1.html" class="text-need">Need help ?</a>
                    </div>
                    <ul class="mb-info">
                        <li>Address: 1234 Fashion Street, Suite 567, <br> New York, NY 10001</li>
                        <li>Email: <b>info@fashionshop.com</b></li>
                        <li>Phone: <b>(212) 555-1234</b></li>
                    </ul>
                </div>
            </div>
            <div class="mb-bottom">
                <a href="login.html" class="site-nav-icon"><i class="icon icon-account"></i>Login</a>
                <div class="bottom-bar-language">
                    <div class="tf-currencies">
                        <select class="image-select center style-default type-currencies">
                            <option data-thumbnail="images/country/fr.svg">EUR <span>€ | France</span></option>
                            <option data-thumbnail="images/country/de.svg">EUR <span>€ | Germany</span></option>
                            <option selected data-thumbnail="images/country/us.svg">USD <span>$ | United States</span></option>
                            <option data-thumbnail="images/country/vn.svg">VND <span>₫ | Vietnam</span></option>
                        </select>
                    </div>
                    <div class="tf-languages">
                        <select class="image-select center style-default type-languages">
                            <option>English</option>
                            <option>العربية</option>
                            <option>简体中文</option>
                            <option>اردو</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>       
    </div>
    <!-- /mobile menu -->



    <!-- canvasSearch -->
    <div class="offcanvas offcanvas-end canvas-search" id="canvasSearch">
        <livewire:search-among-products />
    </div>
    <!-- /canvasSearch -->

    <!-- toolbarShopmb -->
    <div class="offcanvas offcanvas-start canvas-mb toolbar-shop-mobile" id="toolbarShopmb">
        <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
        <div class="mb-canvas-content">
            <div class="mb-body">
                <ul class="nav-ul-mb" id="wrapper-menu-navigation">
                    @foreach($menu_categories as $category)
                        @include('components.mobile.menu.category-item', ['category' => $category, 'level' => 1])
                    @endforeach
                </ul>
            </div>
            <div class="mb-bottom">
                <a href="shop-default.html" class="tf-btn fw-5 btn-line">View all collection<i class="icon icon-arrow1-top-left"></i></a>
            </div>
        </div>       
    </div>

    <div class="modal modalCentered fade form-sign-in modal-part-content" id="login">
        <livewire:login-modal />
    </div>
    {{-- semi-protected-route --}}
    <!-- /toolbarShopmb -->
    <div class="modal fullRight fade modal-shopping-cart" id="shoppingCart">
        <livewire:mini-cart />
    </div>

    <!-- modal compare -->
    {{-- <div class="offcanvas offcanvas-bottom canvas-compare" id="compare">
        <div class="canvas-wrapper">
            <header class="canvas-header">
                <div class="close-popup">
                    <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
                </div>
            </header>
            <div class="canvas-body">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="tf-compare-list">
                                <div class="tf-compare-head">
                                    <div class="title">Compare Products</div>
                                </div>
                                <div class="tf-compare-offcanvas">
                                    <div class="tf-compare-item">
                                        <div class="position-relative">
                                            <div class="icon">
                                                <i class="icon-close"></i>
                                            </div>
                                            <a href="product-detail.html">
                                                <img class="radius-3" src="{{ asset('images/products/photo-12.jpg') }}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="tf-compare-item">
                                        <div class="position-relative">
                                            <div class="icon">
                                                <i class="icon-close"></i>
                                            </div>
                                            <a href="product-detail.html">
                                                <img class="radius-3" src="{{ asset('images/products/photo-14.jpg') }}" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tf-compare-buttons">
                                    <div class="tf-compare-buttons-wrap">
                                        <a href="compare.html" class="tf-btn radius-3 btn-fill justify-content-center fw-6 fs-14 flex-grow-1 animate-hover-btn ">Compare</a>
                                        <div class="tf-compapre-button-clear-all link">
                                            Clear All
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>       
    </div> --}}
    <!-- /modal compare -->
    
    <!-- modal quick_add -->
    <div class="modal fade modalDemo" id="quick_add">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="header">
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="wrap">
                    <div class="tf-product-info-item">
                        <div class="image">
                            <img src="{{ asset('images/products/photo-12.jpg') }}" alt="">
                        </div>
                        <div class="content">
                            <a href="product-detail.html">Ribbed Tank Top</a>
                            <div class="tf-product-info-price">
                                <!-- <div class="price-on-sale">$8.00</div>
                                <div class="compare-at-price">$10.00</div>
                                <div class="badges-on-sale"><span>20</span>% OFF</div> -->
                                <div class="price">$18.00</div>
                            </div>
                        </div>
                    </div>
                    <div class="tf-product-info-variant-picker mb_15">
                        <div class="variant-picker-item">
                            <div class="variant-picker-label">
                                Color: <span class="fw-6 variant-picker-label-value">Orange</span>
                            </div>
                            <div class="variant-picker-values">
                                <input id="values-orange" type="radio" name="color" checked>
                                <label class="hover-tooltip radius-60" for="values-orange" data-value="Orange">
                                    <span class="btn-checkbox bg-color-orange"></span>
                                    <span class="tooltip">Orange</span>
                                </label>
                                <input id="values-black" type="radio" name="color">
                                <label class=" hover-tooltip radius-60" for="values-black" data-value="Black">
                                    <span class="btn-checkbox bg-color-black"></span>
                                    <span class="tooltip">Black</span>
                                </label>
                                <input id="values-white" type="radio" name="color">
                                <label class="hover-tooltip radius-60" for="values-white" data-value="White">
                                    <span class="btn-checkbox bg-color-white"></span>
                                    <span class="tooltip">White</span>
                                </label>
                            </div>
                        </div>
                        <div class="variant-picker-item">
                            <div class="variant-picker-label">
                                Size: <span class="fw-6 variant-picker-label-value">S</span>
                            </div>
                            <div class="variant-picker-values">
                                <input type="radio" name="size" id="values-s" checked>
                                <label class="style-text" for="values-s" data-value="S">
                                    <p>S</p>
                                </label>
                                <input type="radio" name="size" id="values-m">
                                <label class="style-text" for="values-m" data-value="M">
                                    <p>M</p>
                                </label>
                                <input type="radio" name="size" id="values-l">
                                <label class="style-text" for="values-l" data-value="L">
                                    <p>L</p>
                                </label>
                                <input type="radio" name="size" id="values-xl">
                                <label class="style-text" for="values-xl" data-value="XL">
                                    <p>XL</p>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="tf-product-info-quantity mb_15">
                        <div class="quantity-title fw-6">Quantity</div>
                        <div class="wg-quantity">
                            <span class="btn-quantity minus-btn">-</span>
                            <input type="text" name="number" value="1">
                            <span class="btn-quantity plus-btn">+</span>
                        </div>
                    </div>
                    <div class="tf-product-info-buy-button">
                        <form>
                            <a href="javascript:void(0);" class="tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn btn-add-to-cart"><span>Add to cart -&nbsp;</span><span class="tf-qty-price">$18.00</span></a>
                            <div class="tf-product-btn-wishlist btn-icon-action">
                                <i class="icon-heart"></i>
                                <i class="icon-delete"></i>
                            </div>
                            <a href="index.html#compare" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft" class="tf-product-btn-wishlist box-icon bg_white compare btn-icon-action">
                                <span class="icon icon-compare"></span>
                                <span class="icon icon-check"></span>
                            </a>
                            <div class="w-100">
                                <a href="index.html#" class="btns-full">Buy with <img src="{{ asset('images/footer/zp-logo.svg') }}" class="tw:h-5" alt=""></a>
                                <a href="index.html#" class="payment-more-option">More payment options</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal quick_add -->

    <!-- modal quick_view -->
    <div class="modal fade modalDemo" id="quick_view">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="header">
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="wrap">
                    <div class="tf-product-media-wrap">
                        <div class="swiper tf-single-slide">
                            <div class="swiper-wrapper" >
                                <div class="swiper-slide">
                                    <div class="item">
                                        <img src="{{ asset('images/products/photo-12.jpg') }}" alt="">
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="item">
                                        <img src="{{ asset('images/products/photo-14.jpg') }}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-button-next button-style-arrow single-slide-prev"></div>
                            <div class="swiper-button-prev button-style-arrow single-slide-next"></div>
                        </div>
                    </div>
                    <div class="tf-product-info-wrap position-relative">
                        <div class="tf-product-info-list">
                            <div class="tf-product-info-title">
                                <h5><a class="link" href="product-detail.html">Ribbed Tank Top</a></h5>
                            </div>
                            <div class="tf-product-info-badges">
                                <div class="badges text-uppercase">Best seller</div>
                                <div class="product-status-content">
                                    <i class="icon-lightning"></i>
                                    <p class="fw-6">Selling fast! 48 people have this in their carts.</p>
                                </div>
                            </div>
                            <div class="tf-product-info-price">
                                <div class="price">$18.00</div>
                            </div>
                            <div class="tf-product-description">
                                <p>Nunc arcu faucibus a et lorem eu a mauris adipiscing conubia ac aptent ligula facilisis a auctor habitant parturient a a.Interdum fermentum.</p>
                            </div>
                            <div class="tf-product-info-variant-picker">
                                <div class="variant-picker-item">
                                    <div class="variant-picker-label">
                                        Color: <span class="fw-6 variant-picker-label-value">Orange</span>
                                    </div>
                                    <div class="variant-picker-values">
                                        <input id="values-orange-1" type="radio" name="color-1" checked>
                                        <label class="hover-tooltip radius-60" for="values-orange-1" data-value="Orange">
                                            <span class="btn-checkbox bg-color-orange"></span>
                                            <span class="tooltip">Orange</span>
                                        </label>
                                        <input id="values-black-1" type="radio" name="color-1">
                                        <label class=" hover-tooltip radius-60" for="values-black-1" data-value="Black">
                                            <span class="btn-checkbox bg-color-black"></span>
                                            <span class="tooltip">Black</span>
                                        </label>
                                        <input id="values-white-1" type="radio" name="color-1">
                                        <label class="hover-tooltip radius-60" for="values-white-1" data-value="White">
                                            <span class="btn-checkbox bg-color-white"></span>
                                            <span class="tooltip">White</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="variant-picker-item">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="variant-picker-label">
                                            Size: <span class="fw-6 variant-picker-label-value">S</span>
                                        </div>
                                        <div class="find-size btn-choose-size fw-6">Find your size</div>
                                    </div>
                                    <div class="variant-picker-values">
                                        <input type="radio" name="size-1" id="values-s-1" checked>
                                        <label class="style-text" for="values-s-1" data-value="S">
                                            <p>S</p>
                                        </label>
                                        <input type="radio" name="size-1" id="values-m-1">
                                        <label class="style-text" for="values-m-1" data-value="M">
                                            <p>M</p>
                                        </label>
                                        <input type="radio" name="size-1" id="values-l-1">
                                        <label class="style-text" for="values-l-1" data-value="L">
                                            <p>L</p>
                                        </label>
                                        <input type="radio" name="size-1" id="values-xl-1">
                                        <label class="style-text" for="values-xl-1" data-value="XL">
                                            <p>XL</p>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="tf-product-info-quantity">
                                <div class="quantity-title fw-6">Quantity</div>
                                <div class="wg-quantity">
                                    <span class="btn-quantity minus-btn">-</span>
                                    <input type="text" name="number" value="1">
                                    <span class="btn-quantity plus-btn">+</span>
                                </div>
                            </div>
                            <div class="tf-product-info-buy-button">
                                <form class="">
                                    <a href="index.html#" class="tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn "><span>Add to cart -&nbsp;</span><span class="tf-qty-price">$8.00</span></a>
                                    <a href="javascript:void(0);" class="tf-product-btn-wishlist hover-tooltip box-icon bg_white wishlist btn-icon-action">
                                        <span class="icon icon-heart"></span>
                                        <span class="tooltip">Add to Wishlist</span>
                                        <span class="icon icon-delete"></span>
                                    </a>
                                    <a href="index.html#compare" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft" class="tf-product-btn-wishlist hover-tooltip box-icon bg_white compare btn-icon-action">
                                        <span class="icon icon-compare"></span>
                                        <span class="tooltip">Add to Compare</span>
                                        <span class="icon icon-check"></span>
                                    </a>
                                    <div class="w-100">
                                        <a href="index.html#" class="btns-full">Buy with <img src="{{ asset('images/footer/zp-logo.svg') }}" class="tw:h-5" alt=""></a>
                                        <a href="index.html#" class="payment-more-option">More payment options</a>
                                    </div>
                                </form>
                            </div>
                            <div>
                                <a href="product-detail.html" class="tf-btn fw-6 btn-line">View full details<i class="icon icon-arrow1-top-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal quick_view -->

    <!-- modal find_size -->
    <div class="modal fade modalDemo tf-product-modal" id="find_size">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="header">
                    <div class="demo-title">Size chart</div>
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="tf-rte">
                    <div class="tf-table-res-df">
                        <h6>Size guide</h6>
                        <table class="tf-sizeguide-table">
                            <thead>
                                <tr>
                                    <th>Size</th>
                                    <th>US</th>
                                    <th>Bust</th>
                                    <th>Waist</th>
                                    <th>Low Hip</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>XS</td>
                                    <td>2</td>
                                    <td>32</td>
                                    <td>24 - 25</td>
                                    <td>33 - 34</td>
                                </tr>
                                <tr>
                                    <td>S</td>
                                    <td>4</td>
                                    <td>34 - 35</td>
                                    <td>26 - 27</td>
                                    <td>35 - 26</td>
                                </tr>
                                <tr>
                                    <td>M</td>
                                    <td>6</td>
                                    <td>36 - 37</td>
                                    <td>28 - 29</td>
                                    <td>38 - 40</td>
                                </tr>
                                <tr>
                                    <td>L</td>
                                    <td>8</td>
                                    <td>38 - 29</td>
                                    <td>30 - 31</td>
                                    <td>42 - 44</td>
                                </tr>
                                <tr>
                                    <td>XL</td>
                                    <td>10</td>
                                    <td>40 - 41</td>
                                    <td>32 - 33</td>
                                    <td>45 - 47</td>
                                </tr>
                                <tr>
                                    <td>XXL</td>
                                    <td>12</td>
                                    <td>42 - 43</td>
                                    <td>34 - 35</td>
                                    <td>48 - 50</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tf-page-size-chart-content">
                        <div>
                            <h6>Measuring Tips</h6>
                            <div class="title">Bust</div>
                            <p>Measure around the fullest part of your bust.</p>
                            <div class="title">Waist</div>
                            <p>Measure around the narrowest part of your torso.</p>
                            <div class="title">Low Hip</div>
                            <p class="mb-0">With your feet together measure around the fullest part of your hips/rear.
                            </p>
                        </div>
                        <div>
                            {{-- <img class="sizechart lazyload" data-src="images/shop/products/size_chart2.jpg" src="images/shop/products/size_chart2.jpg" alt=""> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /modal find_size -->
    {{-- <livewire:alert /> --}}
    <!-- auto popup  -->
    {{-- <div class="modal modalCentered fade auto-popup modal-newleter">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-top">
                    <img class="lazyload" data-src="images/item/banner-newleter.jpg" src="images/item/banner-newleter.jpg" alt="home-01">
                    <span class="icon icon-close btn-hide-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="modal-bottom">
                    <h4 class="text-center">Don’t mis out</h4>
                    <h6 class="text-center">Be the first one to get the new product at early bird prices.</h6>
                    <form id="subscribe-form" action="index.html#" class="form-newsletter" method="post" accept-charset="utf-8" data-mailchimp="true">
                        <div id="subscribe-content">
                            <input type="email" name="email-form" id="subscribe-email" placeholder="Email *">
                            <button type="button" id="subscribe-button" class="tf-btn btn-fill radius-3 animate-hover-btn w-100 justify-content-center">Keep me updated</button>
                        </div>
                        <div id="subscribe-msg"></div>
                    </form>
                    <div class="text-center">
                        <a href="index.html#" data-bs-dismiss="modal" class="tf-btn btn-line fw-6 btn-hide-popup">Not interested</a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js" integrity="sha512-WW8/jxkELe2CAiE4LvQfwm1rajOS8PHasCCx+knHG0gBHt8EXxS6T6tJRTGuDQVnluuAvMxWF4j8SNFDKceLFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script> --}}
    <!-- Javascript -->
    @livewireScripts
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/lazysize.min.js') }}" async></script>
    <script type="text/javascript" src="{{ asset('js/wow.min.js') }}"></script>
    @vite(['resources/js/app.js'])
</body>
</html>
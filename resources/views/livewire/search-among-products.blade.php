<div class="canvas-wrapper">
    <header class="tf-search-head">
        <div class="title fw-5">
            @lang('Search among products')
            <div class="close">
                <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
            </div>
        </div>
        <div class="tf-search-sticky">
            <form class="tf-mini-search-frm">
                <fieldset class="text tw:items-center tw:flex"">
                    <input type="text" placeholder="تایپ کنید تا جستجو شروع شود ..." class="" name="text" tabindex="0" value=""
                        aria-required="true" required="" wire:model.live.debounce.300ms='search'>
                    <span class="tw:absolute tw:left-4 tw:mt-1"><i class="icon-search"></i></span>
                </fieldset>
                @if ($search != '' && strlen($search) < 3)
                    <p class="tw:text-gray-700 tw:py-2 tw:px-1 tw:text-sm">حداقل ۳ حرف وارد کنید</p>
                @endif
            </form>
        </div>
    </header>
    <div class="canvas-body p-0">
        <div class="tf-search-content">
            <div>
                <div class="tf-col-content">
                    <div class="tf-search-hidden-inner">
                        @if ($products->count() > 0)
                            @foreach ($products as $product)
                            <div class="tf-loop-item">
                                @if ($product->main_image)
                                <div class="image">
                                    <a href="{{ route('products.show', ['slug' => $product->slug]) }}">
                                        <img src="{{ asset($product->main_image->url) }}" alt="">
                                    </a>
                                </div>
                                @endif
                                <div class="content">
                                    <a href="{{ route('products.show', ['slug' => $product->slug]) }}">{{ $product->title }}</a>
                                    @if ($product->isVariable() || !$product->is_discounted)
                                        <div class="tf-product-info-price">
                                            <p>{{ $product->price_label }}</p>
                                        </div>
                                    @elseif ($product->is_discounted)
                                        <div class="tf-product-info-price">
                                            <div class="compare-at-price">{{ $product->price_label }}</div>
                                            <div class="price-on-sale fw-6">{{ format_price($product->discounted_price) }}</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        @else
                            <p>نتیجه ای برای جستجو یافت نشد.</p>
                        @endif
                    </div>
                </div>
            </div>
            {{-- <div class="tf-cart-hide-has-results">
                <div class="tf-col-quicklink">
                    <div class="tf-search-content-title fw-5">Quick link</div>
                    <ul class="tf-quicklink-list">
                        <li class="tf-quicklink-item">
                            <a href="shop-default.html" class="">Fashion</a>
                        </li>
                        <li class="tf-quicklink-item">
                            <a href="shop-default.html" class="">Men</a>
                        </li>
                        <li class="tf-quicklink-item">
                            <a href="shop-default.html" class="">Women</a>
                        </li>
                        <li class="tf-quicklink-item">
                            <a href="shop-default.html" class="">Accessories</a>
                        </li>
                    </ul>
                </div>
                
            </div> --}}
        </div>
    </div>
</div>
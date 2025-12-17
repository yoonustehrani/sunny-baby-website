<div class="canvas-wrapper tw:relative the_search">
    <div class="tf-search-head">
        <div class="tf-search-sticky tw:p-3">
            <form wire:ignore action="{{ route('search') }}" class="tf-mini-search-frm">
                <fieldset class="text tw:items-center tw:flex"">
                    <input type="text" placeholder="تایپ کنید تا جستجو شروع شود ..." name="term" tabindex="0" value=""
                        aria-required="true" required="" wire:model.live.debounce.300ms='search'>
                    <button type="submit" wire:ignore class="tw:absolute tw:m-0 tw:top-3 tw:left-4"><i class="icon-search"></i></button>
                </fieldset>
                @if ($search != '' && strlen($search) < 3)
                    <p class="tw:text-gray-700 tw:py-2 tw:px-1 tw:text-sm">حداقل ۳ حرف وارد کنید</p>
                @endif
            </form>
        </div>
    </div>
    @if (strlen($search) > 2)
        <div class="canvas-body p-0 tw:absolute tw:top-full tw:left-0 tw:w-full tw:p-3 tw:h-80 tw:overflow-y-auto tw:bg-white tw:rounded-b-xl tw:shadow-md">
            <div class="tf-search-content">
                <div>
                    <div class="tf-col-content">
                        <div class="tf-search-hidden-inner tw:flex tw:flex-col tw:gap-3">
                            @if ($products->count() > 0)
                                @foreach ($products as $product)
                                <div class="tf-loop-item tw:flex tw:gap-3 tw:items-center">
                                    @if ($product->main_image)
                                    <div class="image">
                                        <a href="{{ route('products.show', ['slug' => $product->slug]) }}">
                                            <img class="tw:size-10" width="40px" height="40px" src="{{ asset($product->main_image->url) }}" alt="">
                                        </a>
                                    </div>
                                    @endif
                                    <div class="content tw:grow">
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
    @endif
</div>
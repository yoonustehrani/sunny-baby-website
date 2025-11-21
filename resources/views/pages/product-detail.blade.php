<x-layouts.main title="{{ $product->title }}">
    <x-header absolute/>
    <!-- breadcrumb -->
    <div class="tf-breadcrumb tw:mt-20">
        {{-- <div class="container">
            <div class="tf-breadcrumb-wrap d-flex justify-content-between flex-wrap align-items-center">
                <div class="tf-breadcrumb-list">
                    <a href="index.html" class="text">@lang('Home')</a>
                    <i class="icon icon-arrow-left"></i>
                    <a href="product-detail.html#" class="text">Women</a>
                    <i class="icon icon-arrow-left"></i>
                    <span class="text">Cotton jersey top</span>
                </div>
                <div class="tf-breadcrumb-prev-next">
                    <a href="product-detail.html#" class="tf-breadcrumb-prev hover-tooltip center">
                        <i class="icon icon-arrow-left"></i>
                        <!-- <span class="tooltip">Cotton jersey top</span> -->
                    </a>
                    <a href="product-detail.html#" class="tf-breadcrumb-back hover-tooltip center">
                        <i class="icon icon-shop"></i>
                        <!-- <span class="tooltip">Back to Women</span> -->
                    </a>
                    <a href="product-detail.html#" class="tf-breadcrumb-next hover-tooltip center">
                        <i class="icon icon-arrow-right"></i>
                        <!-- <span class="tooltip">Cotton jersey top</span> -->
                    </a>
                </div>
            </div>
        </div> --}}
    </div>
    <!-- default -->
    <section class="flat-spacing-4 pt_0">
        <div class="tf-main-product section-image-zoom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="tf-product-media-wrap sticky-top">
                            <div class="thumbs-slider">
                                <div class="swiper tf-product-media-thumbs other-image-zoom" data-direction="vertical">
                                    <div class="swiper-wrapper stagger-wrap">
                                        @foreach ($product->images as $img)
                                        <div class="swiper-slide stagger-item">
                                            <div class="item">
                                                <img class="lazyload" data-src="{{ asset($img->url) }}" src="{{ asset($img->thumbnail_url) }}" alt="">
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="swiper tf-product-media-main" id="gallery-swiper-started">
                                    <div class="swiper-wrapper" >
                                        @foreach ($product->images as $img)
                                        <div class="swiper-slide">
                                            <a href="{{ asset($img->url) }}" target="_blank" class="item" data-pswp-width="770px" data-pswp-height="1075px">
                                                <img class="tf-image-zoom lazyload" data-zoom="{{ asset($img->url) }}" data-src="{{ asset($img->url) }}" src="{{ asset($img->thumbnail_url) }}" alt="">
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-button-next button-style-arrow thumbs-next"></div>
                                    <div class="swiper-button-prev button-style-arrow thumbs-prev"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="tf-product-info-wrap position-relative">
                            <div class="tf-zoom-main"></div>
                            <div class="tf-product-info-list other-image-zoom">
                                <div class="tf-product-info-title">
                                    <h5 class="tw:text-xl tw:font-bold">{{ $product->title }}</h5>
                                </div>
                                {{-- <div class="tf-product-info-badges">
                                    <div class="badges">Best seller</div>
                                    <div class="product-status-content">
                                        <i class="icon-lightning"></i>
                                        <p class="fw-6">Selling fast! 56 people have  this in their carts.</p>
                                    </div>
                                </div> --}}
                                @if ($product->is_discounted)
                                <div class="tf-product-info-price">
                                    <div class="compare-at-price">{{ $product->price_label }}</div>
                                    <div class="badges-on-sale"><span>{{ $product->discount_in_percent }}</span>% تخفیف</div>
                                </div>
                                <div class="tf-product-info-price">
                                    <div class="price-on-sale">{{ format_price($product->discounted_price) }}</div>
                                </div>
                                @else
                                <div class="tf-product-info-price">
                                    <p class="price tw:text-xl">{{ $product->price_label }}</p>
                                </div>
                                @endif
                                {{-- <div class="tf-product-info-liveview">
                                    <div class="liveview-count">20</div>
                                    <p class="fw-6">@lang('people are viewing this right now')</p>
                                </div> --}}
                                @if ($product->is_discounted && $product->discount->expires_at)
                                    <div class="tf-product-info-countdown">
                                        <div class="countdown-wrap">
                                            <div class="countdown-title">
                                                <i class="icon-time tf-ani-tada"></i>
                                                <p>@lang('HURRY UP! SALE ENDS IN'):</p>
                                            </div>
                                            <div class="tf-countdown style-1">
                                                <div class="js-countdown" dir="rtl" data-timer="{{ $product->discount->expires_at->timestamp - now()->timestamp }}" data-labels="Days :,Hours :,Mins"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <livewire:advanced-add-to-cart-section :$product/>
                                {{-- <div class="tf-product-info-extra-link">
                                    <a href="product-detail.html#compare_color" data-bs-toggle="modal" class="tf-product-extra-icon">
                                        <div class="icon">
                                            <img src="images/item/compare.svg" alt="">
                                        </div>
                                        <div class="text fw-6">Compare color</div>
                                    </a>
                                    <a href="product-detail.html#ask_question" data-bs-toggle="modal" class="tf-product-extra-icon">
                                        <div class="icon">
                                            <i class="icon-question"></i>
                                        </div>
                                        <div class="text fw-6">Ask a question</div>
                                    </a>
                                    <a href="product-detail.html#delivery_return" data-bs-toggle="modal" class="tf-product-extra-icon">
                                        <div class="icon">
                                            <svg class="d-inline-block" xmlns="http://www.w3.org/2000/svg" width="22" height="18" viewBox="0 0 22 18" fill="currentColor"><path d="M21.7872 10.4724C21.7872 9.73685 21.5432 9.00864 21.1002 8.4217L18.7221 5.27043C18.2421 4.63481 17.4804 4.25532 16.684 4.25532H14.9787V2.54885C14.9787 1.14111 13.8334 0 12.4255 0H9.95745V1.69779H12.4255C12.8948 1.69779 13.2766 2.07962 13.2766 2.54885V14.5957H8.15145C7.80021 13.6052 6.85421 12.8936 5.74468 12.8936C4.63515 12.8936 3.68915 13.6052 3.33792 14.5957H2.55319C2.08396 14.5957 1.70213 14.2139 1.70213 13.7447V2.54885C1.70213 2.07962 2.08396 1.69779 2.55319 1.69779H9.95745V0H2.55319C1.14528 0 0 1.14111 0 2.54885V13.7447C0 15.1526 1.14528 16.2979 2.55319 16.2979H3.33792C3.68915 17.2884 4.63515 18 5.74468 18C6.85421 18 7.80021 17.2884 8.15145 16.2979H13.423C13.7742 17.2884 14.7202 18 15.8297 18C16.9393 18 17.8853 17.2884 18.2365 16.2979H21.7872V10.4724ZM16.684 5.95745C16.9494 5.95745 17.2034 6.08396 17.3634 6.29574L19.5166 9.14894H14.9787V5.95745H16.684ZM5.74468 16.2979C5.27545 16.2979 4.89362 15.916 4.89362 15.4468C4.89362 14.9776 5.27545 14.5957 5.74468 14.5957C6.21392 14.5957 6.59575 14.9776 6.59575 15.4468C6.59575 15.916 6.21392 16.2979 5.74468 16.2979ZM15.8298 16.2979C15.3606 16.2979 14.9787 15.916 14.9787 15.4468C14.9787 14.9776 15.3606 14.5957 15.8298 14.5957C16.299 14.5957 16.6809 14.9776 16.6809 15.4468C16.6809 15.916 16.299 16.2979 15.8298 16.2979ZM18.2366 14.5957C17.8853 13.6052 16.9393 12.8936 15.8298 12.8936C15.5398 12.8935 15.252 12.943 14.9787 13.04V10.8511H20.0851V14.5957H18.2366Z"></path></svg>
                                        </div>
                                        <div class="text fw-6">Delivery & Return</div>
                                    </a>
                                    <a href="product-detail.html#share_social" data-bs-toggle="modal" class="tf-product-extra-icon">
                                        <div class="icon">
                                            <i class="icon-share"></i>
                                        </div>
                                        <div class="text fw-6">Share</div>
                                    </a>
                                </div> --}}
                                {{-- <div class="tf-product-info-delivery-return">
                                    <div class="row">
                                        <div class="col-xl-6 col-12">
                                            <div class="tf-product-delivery">
                                                <div class="icon">
                                                    <i class="icon-delivery-time"></i>
                                                </div>
                                                <p>Estimate delivery times: <span class="fw-7">12-26 days</span> (International), <span class="fw-7">3-6 days</span> (United States).</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-12">
                                            <div class="tf-product-delivery mb-0">
                                                <div class="icon">
                                                    <i class="icon-return-order"></i>
                                                </div>
                                                <p>Return within <span class="fw-7">30 days</span> of purchase. Duties & taxes are non-refundable.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="tf-product-info-trust-seal">
                                    <div class="tf-product-trust-mess">
                                        <i class="icon-safe"></i>
                                        <p class="fw-6">Guarantee Safe <br> Checkout</p>
                                    </div>
                                    <div class="tf-payment">
                                        <img src="images/payments/visa.png" alt="">
                                        <img src="images/payments/img-1.png" alt="">
                                        <img src="images/payments/img-2.png" alt="">
                                        <img src="images/payments/img-3.png" alt="">
                                        <img src="images/payments/img-4.png" alt="">
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /default -->
    <section class="flat-spacing-17 pt_0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="widget-tabs style-has-border tw:bg-white">
                        <ul class="widget-menu-tab">
                            {{-- <li class="item-title">
                                <span class="inner">@lang('Description')</span>
                            </li> --}}
                            <li class="item-title active">
                                <span class="inner">ویژگی های محصول</span>
                            </li>
                            {{-- <li class="item-title">
                                <span class="inner">Shipping</span>
                            </li>
                            <li class="item-title">
                                <span class="inner">Return Policies</span>
                            </li> --}}
                        </ul>
                        <div class="widget-content-tab">
                            {{-- <div class="widget-content-inner">
                                {!! $product->description !!}
                            </div> --}}
                            <div class="widget-content-inner active">
                                <table class="tf-pr-attrs">
                                    <tbody>
                                        @foreach ($product->attribute_options->groupBy('attribute.label') as $group => $options)
                                            <tr class="tf-attr-pa-color">
                                                <th class="tf-attr-label">{{ $group }}</th>
                                                <td class="tf-attr-value">
                                                    <p>{{ implode('، ', $options->map(fn($x) => $x->label)->toArray()) }}</p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.main>
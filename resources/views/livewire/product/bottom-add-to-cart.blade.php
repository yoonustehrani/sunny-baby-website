<div class="tf-sticky-btn-atc">
    <div class="container">
        <div class="tf-height-observer w-100 d-flex align-items-center">
            <div class="tf-sticky-atc-product d-flex align-items-center">
                <div class="tf-sticky-atc-img">
                    <img class="lazyloaded" data-src="{{ asset($product->main_image->url) }}" alt="" src="{{ asset($product->main_image->thumbnail_url) }}">
                </div>
                <div class="tf-sticky-atc-title fw-5 d-xl-block d-none">{{ $product->title }}</div>
            </div>
            <div class="tf-sticky-atc-infos">
                <form class="tw:flex tw:items-center tw:gap-6">
                    @if ($product->type === App\Enums\ProductType::VARIABLE)
                    <div class="tf-sticky-atc-variant-price text-center">
                        <select wire:model='selectedVariant' class="tf-select tw:text-gray-700">
                            @foreach ($product->variants as $variant)
                                <option>{{ $variant->variant_title }} - {{ format_price($variant->real_price) }}</option>
                            @endforeach
                        </select>
                    </div>
                    @else
                    <p class="tw:font-bold">{{ format_price($product->real_price) }}</p>
                    @endif
                    <div class="tf-sticky-atc-btns">
                        <div class="tf-product-info-quantity">
                            <div class="wg-quantity">
                                <span class="btn-quantity minus-btn">-</span>
                                <input type="text" name="number" value="1">
                                <span class="btn-quantity plus-btn">+</span>
                            </div>
                        </div>
                        <a href="product-detail.html#" class="tf-btn btn-fill radius-3 justify-content-center fw-6 fs-14 flex-grow-1 animate-hover-btn "><span>@lang('Add to cart')</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
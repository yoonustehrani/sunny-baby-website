<div>
    @if ($product->isVariable())
        <div class="tf-product-info-variant-picker tw:mb-5">
            @foreach ($features as $attr)
                <div class="variant-picker-item">
                    <div class="variant-picker-label">
                        {{ $attr->label }}
                        {{-- : <span class="fw-6 variant-picker-label-value">Beige</span> --}}
                    </div>
                    <div class="variant-picker-values">
                        @if ($attr->isColor())
                            @foreach ($attr->available_options as $option)
                                <input @disabled($option->disabled) wire:model.live='selectedOptions.{{ $attr->id }}' id="attr-option-{{ $option->id }}" type="radio" name="attr-{{ $attr->id }}" value="{{ $option->id }}">
                                <label @if($selectedOptions[$attr->id] == $option->id) wire:click='setOptionAsNull({{ $attr->id }})' @endif @class(['hover-tooltip radius-60', 'tw:border-0' => $option->disabled]) for="attr-option-{{ $option->id }}" data-value="{{ $option->label }}">
                                    <span class="btn-checkbox tw:relative tw:flex tw:items-center tw:justify-center" style="background-color: {{ $option->content }};">
                                        <span class="tw:size-fit tw:absolute {{ $option->disabled ?: 'tw:hidden' }}" style="scale: 250%;margin-top: 10px !important;">X</span>
                                    </span>
                                    <span class="tooltip">{{ $option->label }}</span>
                                </label>
                            @endforeach
                        @else
                        <div class="tw:relative tw:w-fit tw:flex tw:items-center">
                            <select class="tw:appearance-none tw:pl-10 tw:pr-3 tw:py-2 tw:border tw:border-gray-300" wire:model.live='selectedOptions.{{ $attr->id }}'>
                                <option value="">انتخاب کنید</option>
                                @foreach ($attr->available_options as $option)
                                    <option @disabled($option->disabled) value="{{ $option->id }}">
                                        {{ $option->label }} {{ $option->disabled ? '(غیرفعال)' : '' }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="tw:pointer-events-none tw:absolute tw:left-3 tw:flex items-center">
                                <svg class="tw:size-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                 <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    @if (!$product->isVariable() || !is_null($variant))
    <div class="tf-product-info-quantity tw:my-4">
        <p>
            @if ($product->isVariable())
                @if (!is_null($variant))
                    @lang('Stock'):
                    <span class="tw:py-1 tw:px-2 tw:rounded-md tw:bg-gray-200">{{ $variant->stock }}</span>
                @endif
            @else
                @lang('Stock'):
                <span class="tw:py-1 tw:px-2 tw:rounded-md tw:bg-gray-200">{{ $product->stock }}</span>
            @endif
        </p>
    </div>
    @endif
    {{-- <div class="tf-product-info-buy-button">
        <div class="tw:w-full tw:py-3 tw:flex tw:gap-3">
            <a href="javascript:void(0);" class="tf-product-btn-wishlist hover-tooltip box-icon bg_white wishlist btn-icon-action">
                <span class="icon icon-heart"></span>
                <span class="tooltip">@lang("Add to Wishlist")</span>
                <span class="icon icon-delete"></span>
            </a>
            <a href="product-detail.html#compare" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft" class="tf-product-btn-wishlist hover-tooltip box-icon bg_white compare btn-icon-action">
                <span class="icon icon-compare"></span>
                <span class="tooltip">@lang("Add to Compare")</span>
                <span class="icon icon-check"></span>
            </a>
        </div>
    </div> --}}
    {{-- Bottom add to cart --}}
    <div class="tf-sticky-btn-atc tw:w-full tw:right-0">
        <div class="container">
            <div class="tf-height-observer w-100 d-flex align-items-center">
                <div class="tf-sticky-atc-product d-flex align-items-center">
                    @if ($product->main_image)
                        <div class="tf-sticky-atc-img">
                            <img class="lazyloaded" data-src="{{ asset($product->main_image->url) }}" alt="" src="{{ asset($product->main_image->thumbnail_url) }}">
                        </div>
                    @endif
                    <div class="tf-sticky-atc-title fw-5 d-xl-block d-none">{{ $product->title }}</div>
                </div>
                <div class="tf-sticky-atc-infos">
                    <form class="tw:flex tw:items-center tw:gap-6">
                        {{-- @if ($product->type === App\Enums\ProductType::VARIABLE)
                        <div class="tf-sticky-atc-variant-price text-center">
                            <select wire:model.live='selectedVariant' class="tf-select tw:text-gray-700">
                                <option value="" disabled selected>انتخاب کنید</option>
                                @foreach ($product->variants as $variant)
                                    <option value="{{ $variant->id }}">{{ $variant->variant_title }} - {{ format_price($variant->real_price) }}</option>
                                @endforeach
                            </select>
                        </div>
                        @else
                        
                        @endif --}}
                        <div class="tf-sticky-atc-btns tw:flex-wrap tw:lg:flex-nowrap tw:items-center tw:justify-between">
                            <div class="tf-product-info-quantity">
                                <div class="wg-quantity">
                                    <span class="btn-quantity" wire:click='decrement'>-</span>
                                    <input type="text" name="number" wire:model='n'>
                                    <span class="btn-quantity" wire:click='increment'>+</span>
                                </div>
                            </div>
                            <p class="tw:lg:hidden">
                                @if ($product->isVariable())
                                    @if (!is_null($variant))
                                        @lang('Stock'):
                                        <span class="tw:py-1 tw:px-2 tw:rounded-md tw:bg-gray-200">{{ $variant->stock }}</span>
                                    @endif
                                @else
                                    @lang('Stock'):
                                    <span class="tw:py-1 tw:px-2 tw:rounded-md tw:bg-gray-200">{{ $product->stock }}</span>
                                @endif
                            </p>
                            <div class="tw:w-full">
                                @if ($product->isVariable())
                                    <x-buttons.add-to-cart :$n class='tw:w-full! tw:lg:w-fit!' :product='$variant' :disabled='is_null($variant) || $variant->stock == 0'/>
                                @else
                                    <x-buttons.add-to-cart :$n :$product />
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- END --}}
</div>

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
                        @foreach ($attr->available_options as $option)
                            <input @disabled($option->disabled) wire:model.live='selectedOptions.{{ $attr->id }}' id="attr-option-{{ $option->id }}" type="radio" name="attr-{{ $attr->id }}" value="{{ $option->id }}">
                            @if ($attr->isColor())
                                <label @if($selectedOptions[$attr->id] == $option->id) wire:click='setOptionAsNull({{ $attr->id }})' @endif @class(['hover-tooltip radius-60', 'tw:border-0' => $option->disabled]) for="attr-option-{{ $option->id }}" data-value="{{ $option->label }}">
                                    <span class="btn-checkbox tw:flex tw:items-center tw:justify-center" style="background-color: {{ $option->content }};">
                                        @if ($option->disabled)
                                            <span class="tw:mt-1 tw:size-fit">X</span>
                                        @endif
                                    </span>
                                    <span class="tooltip">{{ $option->label }}</span>
                                </label>
                            @else
                                <label @if($selectedOptions[$attr->id] == $option->id) wire:click='setOptionAsNull({{ $attr->id }})' @endif class="style-text" for="attr-option-{{ $option->id }}" data-value="{{ $option->label }}">
                                    <p @class(['tw:line-through' => $option->disabled])>{{ $option->label }}</p>
                                </label>
                            @endif
                        @endforeach
                        {{-- <label class="hover-tooltip radius-60" for="values-beige" data-value="Beige">
                            <span class="btn-checkbox bg-color-beige"></span>
                            <span class="tooltip">Beige</span>
                        </label> --}}
                        {{-- <input id="values-black" type="radio" name="color1"> --}}
                        {{-- 
                        <input id="values-blue" type="radio" name="color1">
                        <label class="hover-tooltip radius-60" for="values-blue" data-value="Blue">
                            <span class="btn-checkbox bg-color-blue"></span>
                            <span class="tooltip">Blue</span>
                        </label>
                        <input id="values-white" type="radio" name="color1">
                        <label class="hover-tooltip radius-60" for="values-white" data-value="White">
                            <span class="btn-checkbox bg-color-white"></span>
                            <span class="tooltip">White</span>
                        </label> --}}
                    </div>
                </div>
            @endforeach
            
            {{-- <div class="variant-picker-item">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="variant-picker-label">
                        Size: <span class="fw-6 variant-picker-label-value">S</span>
                    </div>
                    <a href="product-detail.html#find_size" data-bs-toggle="modal" class="find-size fw-6">Find your size</a>
                </div>
                <div class="variant-picker-values">
                    <input type="radio" name="size1" id="values-s" checked>
                    <label class="style-text" for="values-s" data-value="S">
                        <p>S</p>
                    </label>
                    <input type="radio" name="size1" id="values-m">
                    <label class="style-text" for="values-m" data-value="M">
                        <p>M</p>
                    </label>
                    <input type="radio" name="size1" id="values-l">
                    <label class="style-text" for="values-l" data-value="L">
                        <p>L</p>
                    </label>
                    <input type="radio" name="size1" id="values-xl">
                    <label class="style-text" for="values-xl" data-value="XL">
                        <p>XL</p>
                    </label>
                </div>
            </div> --}}
        </div>
    @endif
    <div class="tf-product-info-quantity">
        <div class="quantity-title fw-6">@lang('Quantity')</div>
        <div class="wg-quantity">
            <span class="btn-quantity minus-btn">-</span>
            <input type="text" name="number" wire:model='n'>
            <span class="btn-quantity plus-btn">+</span>
        </div>
    </div>
    <div class="tf-product-info-buy-button">
        <div class="tw:w-full tw:py-3 tw:flex tw:gap-3">
            @if ($product->isVariable())
                <button @disabled(is_null($variant)) class="tw:disabled:text-gray-500 tw:disabled:bg-gray-300 tw:disabled:border-gray-300 tf-btn btn-fill tw:grow justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn ">
                    <span>@lang('Add to cart')</span>
                    {{-- <span class="tf-qty-price"> -&nbsp; {{ $product->is_discounted ? format_price($product->discounted_price) : format_price($product->price) }}</span> --}}
                </button>
            @else
                <button class="tf-btn btn-fill tw:grow justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn ">
                    <span>@lang('Add to cart') -&nbsp;</span>
                    <span class="tf-qty-price">{{ $product->is_discounted ? format_price($product->discounted_price) : format_price($product->price) }}</span>
                </button>
            @endif
            <a href="javascript:void(0);" class="tf-product-btn-wishlist hover-tooltip box-icon bg_white wishlist btn-icon-action">
                <span class="icon icon-heart"></span>
                <span class="tooltip">Add to Wishlist</span>
                <span class="icon icon-delete"></span>
            </a>
            <a href="product-detail.html#compare" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft" class="tf-product-btn-wishlist hover-tooltip box-icon bg_white compare btn-icon-action">
                <span class="icon icon-compare"></span>
                <span class="tooltip">Add to Compare</span>
                <span class="icon icon-check"></span>
            </a>
        </div>
    </div>
</div>

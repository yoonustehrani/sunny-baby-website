<div>
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
            <a href="product-detail.html#" class="tf-btn btn-fill tw:grow justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn ">
                <span>@lang('Add to cart') -&nbsp;</span>
                <span class="tf-qty-price">{{ $product->is_discounted ? format_price($product->discounted_price) : format_price($product->price) }}</span>
            </a>
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

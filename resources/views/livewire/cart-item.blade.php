<tr class="tf-cart-item file-delete">
    <td class="tf-cart-item_product">
        <a href="product-detail.html" class="img-box">
            <img src="images/products/white-2.jpg" alt="img-product">
        </a>
        <div class="cart-info">
            <a href="product-detail.html" class="cart-title link">{{ $product->title }}</a>
            @if ($product->type === App\Enums\ProductType::VARIATION)
                <div class="cart-meta-variant">White / M</div>
            @endif
            <button type="button" wire:click='update(0)' class="remove-cart link">@lang('Remove')</button>
        </div>
    </td>
    <td class="tf-cart-item_price" cart-data-title="Price">
        <div class="cart-price">{{ format_price($product->price) }}</div>
    </td>
    <td class="tf-cart-item_quantity" cart-data-title="Quantity">
        <div class="cart-quantity">
            <div class="wg-quantity">
                <button type="button" wire:click='update({{ $quantity - 1 }})' class="btn-quantity minus-btn">
                    <svg class="d-inline-block" width="9" height="1" viewBox="0 0 9 1" fill="currentColor"><path d="M9 1H5.14286H3.85714H0V1.50201e-05H3.85714L5.14286 0L9 1.50201e-05V1Z"></path></svg>
                </button>
                <input type="text" name="number" wire:model.live.blur='count'>
                <button type="button" wire:click='update({{ $quantity + 1 }})' class="btn-quantity plus-btn">
                    <svg class="d-inline-block" width="9" height="9" viewBox="0 0 9 9" fill="currentColor"><path d="M9 5.14286H5.14286V9H3.85714V5.14286H0V3.85714H3.85714V0H5.14286V3.85714H9V5.14286Z"></path></svg>
                </button>
            </div>
        </div>
    </td>
    <td class="tf-cart-item_total" cart-data-title="Total">
        <div class="cart-total">{{ format_price($product->price * $quantity) }}</div>
    </td>
</tr>
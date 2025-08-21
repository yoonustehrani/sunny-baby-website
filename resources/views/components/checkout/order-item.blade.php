<li class="checkout-product-item">
    <figure class="img-product">
        <img src="images/products/brown.jpg" alt="product">
        <span class="quantity">{{ $quantity }}</span>
    </figure>
    <div class="content">
        <div class="info">
            <p class="name">{{ $product->title }}</p>
            {{-- <span class="variant">Brown / M</span> --}}
        </div>
        <span class="price">{{ format_price($product->price) }}</span>
    </div>
</li>
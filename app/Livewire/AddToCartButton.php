<?php

namespace App\Livewire;

use App\Facades\Cart;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;

class AddToCartButton extends Component
{
    public Product $product;
    public bool $inCart;
    public int $count;
    public ?string $style;

    public function mount()
    {
        $this->updatedInCart();
    }

    public function updatedCount()
    {
        Cart::update($this->product->id, $this->count);
        $this->dispatchEvents();
    }

    protected function getQuantity()
    {
        return Cart::getProductQuantity($this->product->id);
    }

    protected function dispatchEvents()
    {
        $this->dispatch('cart-updated');
        $this->dispatch('cart-updated-product.'. $this->product->getKey());
    }

    public function add()
    {
        Cart::update($this->product->id, $this->getQuantity() + 1);
        $this->dispatchEvents();
    }

    public function sub()
    {
        Cart::update($this->product->id, $this->getQuantity() - 1);
        $this->dispatchEvents();
    }

    #[On('cart-updated-product.{product.id}')]
    public function updatedInCart()
    {
        $this->inCart = Cart::has($this->product->getKey());
        $this->count = $this->getQuantity();
    }

    public function render()
    {
        return view('livewire.add-to-cart-button');
    }
}

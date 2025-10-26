<?php

namespace App\Traits;

use Livewire\Attributes\On;

trait ProductCartMethods
{
    public bool $inCart;
    public int $count;

    public function mount()
    {
        $this->updatedInCart();
    }
    
    public function add()
    {
        try {
            affiliate_cart()->add($this->product->getKey());
            $this->dispatch('alert', type: 'success', message: __("Added to cart"));
            $this->dispatchEvents();
        } catch (\Throwable $th) {
            $this->dispatch('alert', type: 'error', message: $th->getMessage());
        }
    }

    public function sub()
    {
        try {
            affiliate_cart()->sub($this->product->getKey());
            $this->dispatch('alert', type: 'success', message: __("Subtracted from cart"));
            $this->dispatchEvents();
        } catch (\Throwable $th) {
            $this->dispatch('alert', type: 'error', message: $th->getMessage());
        }
    }

    public function addToCart()
    {
        try {
            affiliate_cart()->update($this->product->getKey(), 1);
            $this->dispatch('alert', type: 'success', message: __("Added to cart"));
            $this->dispatchEvents();
        } catch (\Throwable $th) {
            $this->dispatch('alert', type: 'error', message: $th->getMessage());
        }
    }

    public function removeFromCart()
    {
        try {
            affiliate_cart()->remove($this->product->getKey());
            $this->dispatch('alert', type: 'success', message: __("Removed from cart"));
            $this->dispatchEvents();
        } catch (\Throwable $th) {
            $this->dispatch('alert', type: 'error', message: $th->getMessage());
        }
    }

    protected function dispatchEvents()
    {
        $this->dispatch('cart-updated');
        $this->dispatch('cart-updated-product.'. $this->product->getKey());
    }

    #[On('cart-updated-product.{product.id}')]
    public function updatedInCart()
    {
        $count = affiliate_cart()->getProductQuantity($this->product->getKey());
        $this->inCart = $count > 0;
        $this->count = $count;
    }
}

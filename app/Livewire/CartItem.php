<?php

namespace App\Livewire;

use App\Facades\Cart;
use App\Livewire\Pages\ShowCart;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;

class CartItem extends Component
{
    public Product $product;
    public int $quantity;
    public int $count;

    public function mount()
    {
        $this->count = $this->quantity;
    }

    protected function dispatchEvents()
    {
        $this->dispatch('cart-updated');
        $this->dispatch('cart-updated-product.'. $this->product->getKey());
    }
    
    public function update(int $quantity)
    {
        Cart::update($this->product->getKey(), $quantity);
        $this->dispatchEvents();
    }

    #[On('cart-updated-product.{product.id}')]
    public function productWasUpdated()
    {
        $this->quantity = Cart::getProductQuantity($this->product->getKey());
        $this->count = $this->quantity;
    }

    public function updatedCount()
    {
        $this->update($this->count);
    }

    public function render()
    {
        $slug = $this->product->isVariant() ? $this->product->parent->slug : $this->product->slug;
        $url = route('products.show', ['slug' => $slug]);
        $title = $this->product->title;
        if (!$title && $this->product->isVariant()) {
            $title = $this->product->parent->title;
            $title .= ' - ';
            $title .= implode('، ', $this->product->attribute_options->map(fn($option) => $option->label)->toArray());
        }
        return view('livewire.cart-item', compact('url', 'title'));
    }
}

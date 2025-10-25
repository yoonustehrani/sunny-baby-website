<?php

namespace App\Livewire\Affiliate;

use App\Models\Product;
use Livewire\Component;

class ProductRow extends Component
{
    public Product $product;

    public function add()
    {
        try {
            affiliate_cart()->add($this->product->getKey());
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function sub()
    {
        try {
            affiliate_cart()->sub($this->product->getKey());
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function addToCart()
    {
        try {
            affiliate_cart()->update($this->product->getKey(), 1);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function removeFromCart()
    {
        try {
            affiliate_cart()->remove($this->product->getKey());
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    
    public function render()
    {
        $count = affiliate_cart()->getProductQuantity($this->product->getKey());
        return view('livewire.affiliate.product-row', [
            'inCart' => $count > 0,
            'count' => $count
        ]);
    }
}

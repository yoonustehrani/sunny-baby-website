<?php

namespace App\Livewire\Affiliate;

use App\Enums\OrderStatus;
use App\Enums\OrderType;
use App\Livewire\Forms\AffiliateCheckoutForm;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Shipment;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.affiliate')]
class Checkout extends Component
{
    use WithPagination;

    public AffiliateCheckoutForm $form;

    #[On('select.option.province')]
    public function provinceSelected(int $id)
    {
        $this->form->provinceId = $id;
    }

    #[On('unselect.option.province')]
    public function provinceUnselected()
    {
        $this->form->provinceId = null;
        $this->cityUnselected();
    }

    #[On('select.option.city')]
    public function citySelected(int $id)
    {
        $this->form->cityId = $id;
        $this->form->carrier_class = '';
    }

    #[On('unselect.option.city')]
    public function cityUnselected()
    {
        $this->form->cityId = null;
        $this->form->carrier_class = '';
    }

    public function setSelectedAddress(int $addressId)
    {
        if ($this->form->selectedAddress?->id === $addressId) {
            $this->form->selectedAddress = null;
            return;
        }
        $address = Auth::user()->addresses()->findOrFail($addressId);
        $this->form->selectedAddress = $address;
    }

    public function submit()
    {
        $this->form->validate();
        try {
            DB::beginTransaction();
            $cart = affiliate_cart();
            $cart_items = $cart->toArray()['items'];
            $products = Product::whereIn('id', array_keys($cart_items))->lockForUpdate()->get();
            foreach ($products as $product) {
                if ($product->available_stock < $cart_items[$product->getKey()]) {
                    $cart->remove($product->getKey());
                    throw new Exception("محصول با شناسه ". $product->id . " موجودی کافی ندارد. از سبد شما حذف شد.");
                }
                $product->increment('reserved', $cart_items[$product->getKey()]);
            }
            
            $sums = $cart->sums();
            $shipping_total = get_carrier($this->form->carrier_class, $this->form->getAddressForShipment())->calculate();
            $sums['total'] += $shipping_total;
            /**
             * @var \App\Models\User $user
             */
            $user = Auth::user();
            $order = $user->orders()->save(new Order(
                array_merge(
                    $sums,
                    ['status' => OrderStatus::PENDING], 
                    ['mutable_until' => null],
                    ['type' => OrderType::AFFILIATE_ORDER]
                )
            ));
            $order_items = $cart->all()->map(fn($item) => new OrderItem([
                'product_id' => $item['product']->id,
                'quantity' => $item['quantity'],
                'unit_price' => $item['product']->affiliate_price,
                'unit_discount' => 0
            ]));
            $order->items()->saveMany($order_items);
            if (isset($shipping_total)) {
                $address = $this->form->selectedAddress ?: $user->addresses()->save($this->form->getAddress());
                $order->shipment()->save(new Shipment([
                    'address_id' => $address->id,
                    'carrier_class' => $this->form->carrier_class,
                    'cost' => $shipping_total
                ]));
            }
            DB::commit();
            $this->form->reset();
            $cart->clear();
            try {
                $this->redirectRoute('orders.pay', ['order' => $order->getKey(), 'gateway' => 'zp']);
            } catch (\Throwable $th) {
                $this->redirectRoute('affiliate.orders.index');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function render()
    {
        $user = Auth::user();
        $addresses = $user->addresses()->with('city.province')->paginate(10);
        $data = [
            'cart_total' => affiliate_cart()->sums()['total'],
            'shipping_total' => $this->form->carrier_class && $this->form->getAddressForShipment() ? get_carrier($this->form->carrier_class, $this->form->getAddressForShipment())->calculate() : 0
        ];
        $data['total'] = array_sum($data);
        return view('livewire.affiliate.checkout', array_merge(compact('addresses'), $data))->title(__('Checkout'));
    }
}

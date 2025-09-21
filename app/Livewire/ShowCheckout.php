<?php

namespace App\Livewire;

use App\Enums\DiscountRuleType;
use App\Enums\OrderStatus;
use App\Facades\Cart;
use App\Livewire\Forms\CheckoutForm;
use App\Livewire\Pages\ShowCart;
use App\Models\Discount;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Session;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[On('cart-updated')]
class ShowCheckout extends Component
{
    public CheckoutForm $form;
    protected $listeners = [
        'user-logged-in' => '$refresh',
        'user-logged-out' => '$refresh',
        'cart-updated' => '$refresh'
    ];

    #[Session]
    #[Validate(['string', 'alpha_dash:ascii'])]
    public string $discount_code = '';

    public function mount()
    {
        if (Cart::count() == 0) {
            $this->redirect(ShowCart::class);
        }
        if ($this->form->note == '') {
            $this->form->note = Cart::toArray()['meta']['note'] ?? '';
        }
        if (! Auth::check()) {
            $this->dispatch('semi-protected-route');
        }
    }

    public function applyDiscountCode()
    {
        $this->validateOnly('discount_code');
        $discount = Discount::whereCode($this->discount_code)->unexpired()->active()->first();
        if (! $discount) {
            $this->addError('discount_code.invalid', __('Invalid code'));
            return;
        }
        // check rules
        $this->form->discount = $discount;
        
        /**
         * @var \App\Models\DiscountRule $rule
         */
        foreach ($this->rules as $rule) {
            $value1 = null;
            $value2 = $rule->value;
            switch ($rule->type) {
                case DiscountRuleType::CART_TOTAL:
                    $value1 = Cart::sums()['total'];
                    break;
                case DiscountRuleType::ORDER_ADDRESS_CITY:
                    $value1 = $this->form->cityId;
                    break;
                case DiscountRuleType::ORDER_ADDRESS_STATE:
                    $value1 = $this->form->provinceId;
                    break;
                case DiscountRuleType::SPECIFIC_PRODUCT_IN_CART:
                    $value1 = Cart::all()->pluck('product.id');
                    break;
                // case SUCCESSFUL_PREVIOUS_ORDERS:
                // case DiscountRuleType::PAYMENT_METHOD:
                //     break;
                case DiscountRuleType::SHIPPING_METHOD:
                    $value1 = $this->form->carrier_class;
                    break;
            }
            if (! dynamic_compare($value1, $value2, $rule->operator)) {
                return false;
            }
        }

    }

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
        $this->setCarrierClass(null);
    }

    #[On('unselect.option.city')]
    public function cityUnselected()
    {
        $this->form->cityId = null;
        $this->setCarrierClass(null);
    }

    public function setCarrierClass(?string $class = null)
    {
        $this->form->carrier_class = $class;
    }
    
    public function submit()
    {
        $this->form->validate();
        $order_items = Cart::all()->map(fn($item) => new OrderItem([
            'product_id' => $item['product']->id,
            'quantity' => $item['quantity'],
            'unit_price' => $item['product']->price,
            'unit_discount' => $item['product']->is_discounted ? $item['product']->discount_amount : 0
        ]));
        $shipping_total = get_carrier($this->form->carrier_class, $this->form->getAddressForShipment())->calculate();
        $sums = Cart::sums();
        $sums['total'] += $shipping_total;
        try {
            DB::beginTransaction();
            $user = Auth::user();
            if ($user == null) {
                $user = User::firstOrCreate(
                    ['phone_number' => $this->form->phone]
                );
            }
            $order = $user->orders()->save(new Order(array_merge(
                $sums, ['status' => OrderStatus::PENDING]
            )));
            $order->items()->saveMany($order_items);
            $address = $user->addresses()->save($this->form->getAddress());
            $order->shipment()->save(new Shipment([
                'address_id' => $address->id,
                'carrier_class' => $this->form->carrier_class,
                'cost' => $shipping_total
            ]));
            DB::commit();
            $this->form->reset();
            Cart::clear();
            $this->redirectRoute('orders.pay', ['order' => $order->getKey(), 'gateway' => 'zp']);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function render()
    {
        if (Cart::count() == 0) {
            $this->redirect(ShowCart::class);
        }
        $data = [
            'cart_total' => Cart::sums()['total'],
            'shipping_total' => $this->form->carrier_class && $this->form->getAddressForShipment() ? get_carrier($this->form->carrier_class, $this->form->getAddressForShipment())->calculate() : 0
        ];
        $data['total'] = array_sum($data);
        if (Auth::check()) {
            $data['user'] = Auth::user();
            if (! $this->form->phone) {
                $this->form->phone = Auth::user()?->phone_number;
            }
            if (! $this->form->fullname && Auth::user()?->name) {
                $this->form->fullname = Auth::user()->name;
            }
        }
        return view('livewire.show-checkout', $data)
            ->title(__('Check out'));
    }
}

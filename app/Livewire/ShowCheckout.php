<?php

namespace App\Livewire;

use App\Enums\DiscountRuleType;
use App\Facades\Cart;
use App\Livewire\Forms\CheckoutForm;
use App\Livewire\Pages\ShowCart;
use App\Models\Discount;
use Livewire\Attributes\On;
use Livewire\Attributes\Session;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[On('cart-updated')]
class ShowCheckout extends Component
{
    public CheckoutForm $form;

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
    }

    #[On('unselect.option.city')]
    public function cityUnselected()
    {
        $this->form->cityId = null;
    }

    public function setCarrierClass(?string $class = null)
    {
        $this->form->carrier_class = $class;
    }

    public function render()
    {
        $total = Cart::sums()['total'];
        return view('livewire.show-checkout', compact('total'))->title(__('Check out'));
    }
}

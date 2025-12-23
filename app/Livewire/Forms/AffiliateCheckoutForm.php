<?php

namespace App\Livewire\Forms;

use App\Enums\CheckoutType;
use App\Models\Address;
use App\Models\Discount;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Session;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AffiliateCheckoutForm extends Form
{
    #[Session()]
    public string $fullname = '';

    #[Session]
    public string $phone_number = '';

    #[Session]
    public string $address = '';

    #[Session]
    public string $zip = '';

    #[Session]
    public string $note = '';

    #[Session]
    public ?int $provinceId = null;

    #[Session]
    public ?int $cityId = null;

    #[Session]
    public string $carrier_class = '';

    #[Session]
    public ?Discount $discount;

    #[Session]
    public bool $finalize = false;

    #[Session]
    public CheckoutType $checkout_type = CheckoutType::DEFAULT;

    #[Session]
    public ?int $mutable_order_id;

    #[Session]
    public ?Address $selectedAddress = null;

    protected function rules()
    {
        if ($this->selectedAddress) {
            return [
                'carrier_class' => 'required',
            ];
        }
        return [
            'fullname' => 'required|string|min:3',
            'phone_number' => 'required|numeric|regex:/09[0-9]{9}/',
            'address' => 'required|string|min:6',
            'zip' => 'numeric|digits:10',
            'note' => 'string|min:3',
            'provinceId' => 'required|exists:provinces,id',
            'cityId' => 'required|exists:cities,id',
            'carrier_class' => [Rule::requiredIf(fn() => !is_null($this->provinceId) && !is_null($this->cityId) )],
            // && $this->finalize == true
            // 'checkout_type' => ['required', Rule::enum(CheckoutType::class)],
            // 'mutable_order_id' => [Rule::requiredIf(fn() => $this->checkout_type == CheckoutType::ADD_TO_PREVIOUS_ORDER)]
        ];
    }

    public function getAddressForShipment(): ?Address
    {
        if ($this->selectedAddress) {
            return $this->selectedAddress;
        }
        if ($this->provinceId && $this->cityId) {
            return new Address([
                'city_id' => $this->cityId
            ]);
        }
        return null;
    }

    public function getAddress(): ?Address
    {
        $address = $this->getAddressForShipment();
        if (!$address || ! $this->phone_number || !$this->fullname || !$this->address) {
            return null;
        }
        if ($this->zip) {
            $address->zip = $this->zip;
        }
        return $address->fill([
            // 'zip'=> $this->zip ?: '11',
            'phone_number'=> $this->phone_number,
            'fullname'=> $this->fullname,
            'text' => $this->address
        ]);
    }
}

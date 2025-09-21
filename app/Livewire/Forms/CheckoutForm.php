<?php

namespace App\Livewire\Forms;

use App\Models\Address;
use App\Models\Discount;
use Livewire\Attributes\On;
use Livewire\Attributes\Session;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CheckoutForm extends Form
{
    #[Session]
    #[Validate('required|string|min:3')]
    public string $fullname = '';

    #[Session]
    #[Validate('required|numeric|regex:/09[0-9]{9}/')]
    public string $phone = '';

    #[Session]
    #[Validate('required|string|min:6')]
    public string $address = '';

    #[Session]
    #[Validate('numeric|digits:10')]
    public string $zip = '';

    #[Session]
    #[Validate('string|min:3')]
    public string $note = '';

    #[Session]
    #[Validate('required|exists:provinces,id')]
    public ?int $provinceId = null;

    #[Session]
    #[Validate('required|exists:cities,id')]
    public ?int $cityId = null;

    #[Session]
    #[Validate('required_with_all:provinceId,cityId')]
    public ?string $carrier_class = null;

    #[Session]
    public ?Discount $discount;

    public function getAddressForShipment(): ?Address
    {
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
        if (!$address || ! $this->phone || !$this->fullname || !$this->address) {
            return null;
        }
        return $address->fill([
            'zip'=> $this->zip ?: null,
            'phone_number'=> $this->phone,
            'fullname'=> $this->fullname,
            'text' => $this->address
        ]);
    }
}

<?php

namespace App\Livewire\Forms;

use App\Models\Address;
use Livewire\Attributes\On;
use Livewire\Attributes\Session;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CheckoutForm extends Form
{
    #[Session]
    public string $fullname = '';

    #[Session]
    public string $email = '';

    #[Session]
    public string $phone = '';

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

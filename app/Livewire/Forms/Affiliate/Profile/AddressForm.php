<?php

namespace App\Livewire\Forms\Affiliate\Profile;

use App\Models\Address;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AddressForm extends Form
{
    public ?int $province_id = null;
    public ?int $city_id = null;

    public string $address = '';
    public string $zip = '';

    public function setAddress(Address $address)
    {
        $this->province_id = $address->city->province_id;
        $this->city_id = $address->city_id;
        $this->address = $address->text;
        $this->zip = $address->zip;
    }

    protected function rules()
    {
        return [
            'address' => 'required|string|min:6',
            'zip' => 'required|numeric|digits:10',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
        ];
    }
}

<?php

namespace App\Livewire\Forms\Affiliate\Profile;

use App\Models\AffiliateBusiness;
use Livewire\Attributes\Validate;
use Livewire\Form;

class BusinessForm extends Form
{
    #[Validate('required|string|min:3|max:60')]
    public string $brand_name = '';
    #[Validate('required|numeric')]
    public string $support_phone_number = '';
    #[Validate('nullable|image|max:1024')]
    public $image;

    public function setBusiness(AffiliateBusiness $business)
    {
        $this->brand_name = $business->brand_name;
        $this->support_phone_number = $business->support_phone_number;
    }
}

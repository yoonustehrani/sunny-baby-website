<?php

namespace App\Livewire\Affiliate;

use App\Livewire\Forms\Affiliate\Profile\AddressForm;
use App\Livewire\Forms\Affiliate\Profile\BusinessForm;
use App\Models\Address;
use App\Models\AffiliateBusiness;
use App\Models\Image;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

use function PHPSTORM_META\type;

#[Layout('components.layouts.affiliate')]
class Profile extends Component
{
    use WithFileUploads;

    public AddressForm $addressForm;
    public BusinessForm $businessForm;

    public function mount()
    {
        /**
         * @var \App\Models\User $user
         */
        $user = Auth::user();
        $user->load('business.address');
        if ($user->business) {
            $this->businessForm->setBusiness($user->business);
            if ($user->business->address) {
                $this->addressForm->setAddress($user->business->address);
            }
        }
    }

    #[On('select.option.province')]
    public function provinceSelected(int $id)
    {
        $this->addressForm->province_id = $id;
    }

    #[On('unselect.option.province')]
    public function provinceUnselected()
    {
        $this->addressForm->province_id = null;
        $this->cityUnselected();
    }

    #[On('select.option.city')]
    public function citySelected(int $id)
    {
        $this->addressForm->city_id = $id;
    }

    #[On('unselect.option.city')]
    public function cityUnselected()
    {
        $this->addressForm->city_id = null;
    }

    public function updateAddress()
    {
        $this->addressForm->validate();
        /**
         * @var \App\Models\User $user
         */
        $user = Auth::user();
        $user->load('business.address');
        if (! $user->business) {
            throw new Exception('No business specified');
        }
        $address = $user->business->address ?: new Address();
        $address->fill([
            'fullname' => $user->name ?: '',
            'phone_number' => $user->phone_number,
            'text' => $this->addressForm->address,
            'zip' => $this->addressForm->zip,
            'city_id' => $this->addressForm->city_id
        ]);
        if ($address->id) {
            $address->save();
        } else {
            $user->business->address()->save($address);
        }
        $this->dispatch('alert', type: 'success', message: 'با موفقیت ذخیره شد');
    }

    public function updateBusiness()
    {
        $this->businessForm->validate();
        /**
         * @var \App\Models\User $user
         */
        $user = Auth::user();
        if (! $this->businessForm->image && (! $user->business || ! $user->business->image_id)) {
            $this->businessForm->addError('image', __('validation.required', ['attribute' => __('Logo')]));
            return;
        }
        try {
            DB::beginTransaction();
            /**
             * @var \App\Models\AffiliateBusiness $business
             */
            $business = $user->business()->first() ?: new AffiliateBusiness([
                'user_id' => $user->id
            ]);
            $business->fill([
                'brand_name' => $this->businessForm->brand_name,
                'support_phone_number' => $this->businessForm->support_phone_number,
            ]);
            if ($this->businessForm->image) {
                $image_path = $this->businessForm->image->storePublicly('business', 'public');
                $image = new Image([
                    'url' => 'storage/' . $image_path,
                    'thumbnail_url' => $image_path
                ]);
                $image->save();
                $business->logo()->associate($image);
            }
            $business->save();
            DB::commit();
            $this->dispatch('alert', type: 'success', message: 'با موفقیت ذخیره شد');
        } catch (\Throwable $th) {
            DB::rollBack();
            if ($this->businessForm->image) {
                Storage::delete($image_path);
            }
            throw $th;
        }
    }

    public function render()
    {
        /**
         * @var \App\Models\User $user
         */
        $user = Auth::user();
        $user->load(['business' => function($q) {
            $q->with('logo', 'address');
        }]);
        return view('livewire.affiliate.profile', compact('user'))->title(__('Profile'));
    }
}

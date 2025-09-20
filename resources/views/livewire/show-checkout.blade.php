<section class="flat-spacing-11">
    <div class="container">
        <div class="tf-page-cart-wrap layout-2">
            <div class="tf-page-cart-item">
                <h5 class="fw-5 mb_20">@lang('Billing details')</h5>
                @auth
                    {{ $user->phone_number }}
                @endauth
                <form class="form-checkout">
                    <div class="box grid-2">
                        <fieldset class="fieldset">
                            <label for="fullname">@lang('Fullname')</label>
                            <input required type="text" wire:model.live.blur='form.fullname' id="fullname">
                        </fieldset>
                        <fieldset class="fieldset">
                            <label for="phone">@lang('Phone Number')</label>
                            <input required type="text" wire:model.live.blur='form.phone' id="phone">
                        </fieldset>
                    </div>
                    <div class="box grid-2">
                        <livewire:search-model-input required modelClass='\App\Models\Province' :value='$form->provinceId' name='province' :label='__("Province")'/>
                        @if ($form->provinceId)
                            <livewire:search-model-input required where="province_id='{{ $form->provinceId }}'" modelClass='\App\Models\City' :value='$form->cityId' name='city' :label='__("City") . "/" . __("Town")'/>
                        @endif
                    </div>
                    <fieldset class="box fieldset">
                        <label for="zip">@lang('Zip')</label>
                        <input type="text" wire:model.live.blur='form.zip' id="zip" placeholder="اگر کد پستی ندارید خالی بگذارید.">
                    </fieldset>
                    <fieldset class="box fieldset">
                        <label for="address">@lang('Address')</label>
                        <textarea required wire:model.live.blur='form.address' id="address"></textarea>
                    </fieldset>
                    <fieldset class="box fieldset">
                        <label for="note">@lang('Order notes') (@lang('optional'))</label>
                        <textarea wire:model.live.blur='form.note' id="note"></textarea>
                    </fieldset>
                </form>
            </div>
            <div class="tf-page-cart-footer">
                <div class="tf-cart-footer-inner">
                    <h5 class="fw-5 mb_20">@lang('Your order')</h5>
                    <form class="tf-page-cart-checkout widget-wrap-checkout">
                        <ul class="wrap-checkout-product">
                            @foreach (\App\Facades\Cart::all() as $key => $item)
                                <x-checkout.order-item wire:key="cart-item-{{ $item['product']->id }}" :product="$item['product']" :quantity="$item['quantity']"/>
                            @endforeach
                        </ul>
                        {{-- <div class="coupon-box">
                            <input type="text" wire:model.blur='discount_code' placeholder="@lang('Discount code')">
                            <button wire:click='applyDiscountCode' type="button" class="tf-btn btn-sm radius-3 btn-fill btn-icon animate-hover-btn">@lang('Apply')</button>
                        </div> --}}
                        <div class="d-flex justify-content-between line pb_20">
                            <h6 class="fw-5">@lang('Total')</h6>
                            <h6 class="total fw-5">{{ format_price($cart_total) }}</h6>
                        </div>
                        @if ($form->getAddressForShipment())
                            @php
                                $active_carriers = collect(\App\Facades\Shipping::carriers())
                                    ->map(fn($x) => get_carrier($x, $form->getAddressForShipment()))
                                    ->filter(fn($x) => $x->isActive())
                                    ->keyBy(fn($x) => $x::class);
                            @endphp
                            <div>{{ $form->carrier_class }}</div>
                            @foreach ($active_carriers as $carrierClass => $carrier)
                                <label for="{{ str_replace('\\', '-', $carrierClass) }}" class="tw:flex tw:cursor-pointer tw:items-center tw:justify-between tw:p-4 tw:border tw:rounded-md tw:border-black/10 tw:shadow-sm">
                                    <div class="tw:flex tw:gap-4 tw:items-center">
                                        <div class="tw:bg-white tw:dark:bg-gray-100 tw:rounded-full tw:w-4 tw:h-4 tw:flex tw:flex-shrink-0 tw:justify-center tw:items-center tw:relative">
                                            {{-- || $active_carriers->count() == 1 --}}
                                            <input id="{{ str_replace('\\', '-', $carrierClass) }}" wire:model.live='form.carrier_class' value='{{ $carrierClass }}' type="radio" class="checkbox tw:appearance-none tw:focus:opacity-100 tw:focus:ring-2 tw:focus:ring-offset-2 tw:focus:ring-indigo-700 tw:focus:outline-none tw:border tw:rounded-full tw:border-gray-400 tw:absolute tw:cursor-pointer tw:w-full tw:h-full tw:checked:border-none" />
                                            <div class="check-icon tw:hidden tw:border-4 tw:border-indigo-700 tw:rounded-full tw:w-full tw:h-full tw:z-1"></div>
                                        </div>
                                        <div class="tw:flex tw:flex-col tw:gap-2">
                                            <h4 class="tw:text-base tw:font-bold">{{ $carrier->getName() }}</h4>
                                            <p class="tw:text-xs">{{ $carrier->getDescription() }}</p>
                                        </div>
                                        <span>-</span>
                                        <span>{{ $carrier->getPriceLabel() }}</span>
                                    </div>
                                    <img class="tw:h-12 tw:w-auto" src="{{ $carrier->getLogoUrl() }}" alt="{{ $carrier->getName() }}">
                                </label>
                            @endforeach
                            {{-- <hr class="tw:border-gray-400/80"> --}}
                            <div class="d-flex justify-content-between line pb_20 tw:mt-3">
                                <h6 class="tw:text-sm">@lang('Total weight')</h6>
                                <h6 class="total tw:text-sm">{{ number_format(\App\Facades\Cart::getTotalWeight()) }} گرم</h6>
                            </div>
                            @if ($form->carrier_class)
                                <div class="tw:flex tw:flex-col tw:gap-4 line pb_20">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="tw:text-sm">@lang('Subtotal')</h6>
                                        <h6 class="total tw:text-sm">{{ format_price($cart_total) }}</h6>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h6 class="tw:text-sm">@lang('Shipping fare')</h6>
                                        <h6 class="total tw:text-sm">{{ get_carrier($form->carrier_class, $form->getAddressForShipment())->getPriceLabel() }}</h6>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <h6 class="fw-5">@lang('To be paid')</h6>
                                        <h6 class="total fw-5">{{ format_price($total) }}</h6>
                                    </div>
                                </div>
                            @endif
                        @endif
                        <div class="wd-check-payment">
                            <div class="fieldset-radio mb_20">
                                <input type="radio" name="payment" id="bank" class="tf-check" checked>
                                <label for="bank">Direct bank transfer</label>
                                
                            </div>
                            <div class="fieldset-radio mb_20">
                                <input type="radio" name="payment" id="delivery" class="tf-check">
                                <label for="delivery">Cash on delivery</label>
                            </div>
                            <p class="text_black-2 mb_20">اطلاعات شخصی شما برای پردازش سفارش، پشتیبانی از تجربه شما در این وبسایت و سایر اهداف شرح داده شده در <a href="terms-conditions.html" class="text-decoration-underline">سیاست حفظ حریم خصوصی</a> ما استفاده خواهد شد.</p>
                            {{-- <p class="text_black-2 mb_20">Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="privacy-policy.html" class="text-decoration-underline">privacy policy</a>.</p> --}}
                            <div class="box-checkbox fieldset-radio mb_20">
                                <input type="checkbox" id="check-agree" class="tf-check">
                                <label for="check-agree" class="text_black-2"><a href="terms-conditions.html" class="text-decoration-underline">شرایط و قوانین سایت</a> را مطالعه کرده‌ام و می‌پذیرم.</label>
                            </div>
                        </div>
                        <button class="tf-btn radius-3 btn-fill btn-icon animate-hover-btn justify-content-center">@lang('Place order')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
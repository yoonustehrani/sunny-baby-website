<section class="flat-spacing-11">
    <div class="container">
        <div class="tf-page-cart-wrap layout-2">
            <div class="tf-page-cart-item">
                <h5 class="fw-5 mb_20">@lang('Billing details')</h5>
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
                        {{-- <fieldset class="fieldset">
                            <label for="city">@lang('City')/@lang('Town')</label>
                            <input @disabled(! is_null($form->province)) type="text">
                        </fieldset> --}}
                    </div>
                    <fieldset class="box fieldset">
                        <label for="address">@lang('Address')</label>
                        <input type="text" wire:model.live.blur='form.address' id="address">
                    </fieldset>
                    {{-- <fieldset class="box fieldset">
                        <label for="email">@lang('Email')</label>
                        <input type="email" id="email">
                    </fieldset> --}}
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
                            <x-checkout.order-item />
                        </ul>
                        <div class="coupon-box">
                            <input type="text" placeholder="@lang('Discount code')">
                            <a href="checkout.html#" class="tf-btn btn-sm radius-3 btn-fill btn-icon animate-hover-btn">@lang('Apply')</a>
                        </div>
                        <div class="d-flex justify-content-between line pb_20">
                            <h6 class="fw-5">@lang('Total')</h6>
                            <h6 class="total fw-5">$122.00</h6>
                        </div>
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
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="header">
            <div class="demo-title">@lang('Login')/@lang('Register')</div>
            <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
        </div>
        @guest
        <div class="tf-login-form">
            <form accept-charset="utf-8" wire:submit='submit'>
                @if ($final)
                    <div class="tw:my-3">{{ $phone_number }}</div>
                    <button wire:click='resendCode' type="button" class="">ارسال مجدد</button>
                @endif
                <div class="tf-field style-1">
                    @if ($final)
                        <input wire:model.change='code' minlength="4" maxlength='4' dir="ltr" id="login-code" placeholder="کد چهار رقمی ارسال شده به شماره همراه شما" class="tw:text-gray-700! tw:placeholder:text-base tw:focus:placeholder:text-gray-500! tf-field tf-input tw:text-left tw:text-xl tw:p-4" type="text">
                    @else
                        <input wire:model.change='phone_number' minlength="11" maxlength='11' dir="ltr" id="login-phone-number" placeholder="شماره تلفن همراه با صفر" class="tw:text-gray-700! tw:placeholder:text-base tw:focus:placeholder:text-gray-500! tf-field tf-input tw:text-left tw:text-xl tw:p-4" type="text">
                    @endif
                    <label class="tf-field-label tw:text-gray-700!" for="login-phone-number">@lang($final ? 'OTP code' : 'Phone Number') *</label>
                </div>
                @error('code')
                    <p class="tw:p-2 tw:text-red-500">{{ $message }}</p>
                @enderror
                @error('phone_number')
                    <p class="tw:p-2 tw:text-red-500">{{ $message }}</p>
                @enderror
                <div class="bottom"> 
                    <div class="w-100">
                        <button type="submit" @if(strlen($phone_number) < 11) disabled @endif class="tw:disabled:bg-gray-300 tw:disabled:bg-gray-200 tw:disabled:border-0 tf-btn btn-fill animate-hover-btn radius-3 w-100 justify-content-center">
                            <span>{{ $final ? __('Login') : __('Request OTP') }}</span>
                        </button>
                    </div>
                    {{-- <div class="w-100">
                        <a href="index.html#register" data-bs-toggle="modal" class="btn-link fw-6 w-100 link">
                            New customer? Create your account
                            <i class="icon icon-arrow1-top-left"></i>
                        </a>
                    </div> --}}
                </div>
            </form>
        </div>
        @else
        <p>شما وارد حساب خود شده اید.</p>
        @endguest
    </div>
</div>
<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="header">
            <div class="demo-title">@lang('Login')</div>
            <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
        </div>
        <div class="tf-login-form">
            <form accept-charset="utf-8">
                <div class="tf-field style-1">
                    <input wire:model.live.debounce.750ms='phone_number' dir="ltr" id="login-phone-number" placeholder="شماره تلفن همراه با صفر" class="tw:text-gray-700! tw:placeholder:text-base tw:focus:placeholder:text-gray-500! tf-field tf-input tw:text-left tw:text-xl tw:p-4" type="text">
                    <label class="tf-field-label tw:text-gray-700!" for="login-phone-number">@lang('Phone Number') *</label>
                </div>
                <div class="bottom"> 
                    <div class="w-100">
                        <button type="submit" @if(strlen($phone_number) < 11) disabled @endif class="tw:disabled:bg-gray-300 tw:disabled:bg-gray-200 tw:disabled:border-0 tf-btn btn-fill animate-hover-btn radius-3 w-100 justify-content-center"><span>@lang('Login')</span></button>
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
    </div>
</div>
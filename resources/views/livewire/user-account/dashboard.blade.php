<div class="my-account-content account-dashboard">
    <div class="mb_60">
        <h5 class="fw-5 mb_20">@lang('Welcome')</h5>
        <p>
            @lang('From your account dashboard you can')
            <a class="text_primary" href="{{ route('user-account.orders') }}">@lang("view your recent orders")</a>
            @lang('and')
            <a class="text_primary" href="{{ route('user-account.addresses') }}">@lang("manage your addresses")</a>.
        </p>
    </div>                        
</div>
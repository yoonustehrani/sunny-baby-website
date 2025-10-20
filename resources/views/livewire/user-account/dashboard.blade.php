<div class="my-account-content account-dashboard">
    <div class="tw:my-3">
        <h5 class="fw-5 mb_20">@lang('Welcome')</h5>
        <p>
            @lang('From your account dashboard you can')
            <a class="text_primary" href="{{ route('user-account.orders') }}">@lang("view your recent orders")</a>
            @lang('and')
            <a class="text_primary" href="{{ route('user-account.addresses') }}">@lang("manage your addresses")</a>.
        </p>
    </div>
    <div class="tw:my-3">
        <div class="tw:p-3 tw:bg-white tw:shadow-md tw:flex tw:gap-3 tw:w-fit tw:rounded-xl tw:items-center">
            <svg width="35px" height="35px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
            <div class="tw:flex tw:flex-col tw:gap-2">
                <span class="tw:text-lg tw:font-bold">اعتبار کیف پول</span>
                <span>{{ format_price($user->credit) }}</span>
            </div>
        </div>
    </div>
</div>
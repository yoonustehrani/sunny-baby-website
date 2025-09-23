<li class="nav-account"
    x-data="{ loggedIn: @json(auth()->check()) }"
    x-on:user-logged-in.window="loggedIn = true;"
    x-on:user-logged-out.window="loggedIn = false"
    >
    {{-- Visible when logged in --}}
    <a href="{{ route('user-account.dashboard') }}" class="tw:h-5" x-show="loggedIn" x-cloak>
        <i class="icon icon-account"></i>
    </a>
    {{-- Visible when guest --}}
    <button x-show="!loggedIn" 
        type="button"
        class="nav-icon-item" 
        data-bs-toggle="modal" 
        data-bs-target="#login"
        x-on:semi-protected-route.window='$el.click()'
        >
        <i class="icon icon-account"></i>
    </button>
</li>
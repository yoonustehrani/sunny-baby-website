<li class="nav-account"
    x-data="{ loggedIn: @json(auth()->check()) }"
    x-on:user-logged-in.window="loggedIn = true;"
    x-on:user-logged-out.window="loggedIn = false"
    >
    {{-- Visible when logged in --}}
    <a href="/my-account" x-show="loggedIn" x-cloak>
        <i class="icon icon-account"></i>
    </a>
    {{-- Visible when guest --}}
    <a x-show="!loggedIn" x-cloak href="index.html#login" data-bs-toggle="modal" class="nav-icon-item"><i class="icon icon-account"></i></a>
</li>
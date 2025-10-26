<!doctype html>
<html lang="fa">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    @livewireStyles
    @vite(['resources/css/affiliate.css'])
    <title>{{ $title ?? __('Dashboard') }} | @lang('Affiliate Panel')</title>
</head>
@php
    $user = auth()->user();
@endphp
<body dir="rtl"
    x-data="{ page: 'dashboard', 'loaded': false, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
            darkMode = JSON.parse(localStorage.getItem('darkMode'));
            $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark bg-gray-900': darkMode === true}">
    <div x-show="loaded"
        x-init="window.addEventListener('DOMContentLoaded', () => {setTimeout(() => loaded = false, 500)})"
        class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-white dark:bg-gray-900">
        <div class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-brand-500 border-t-transparent">
        </div>
    </div>
    {{-- Page Wrapper --}}
    <div class="flex h-full w-full overflow-hidden">
        @include('affiliate.sidebar')
        <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
            <div @click="sidebarToggle = false" :class="sidebarToggle ? 'block lg:hidden' : 'hidden'"
                class="fixed w-full h-screen z-9 bg-gray-900/50"></div>
            @include('affiliate.header')
            <main>
                <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
                    <div class="h-full w-full overflow-y-auto overflow-x-hidden">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>
    </div>
    {{-- End - Page Wrapper --}}
    @livewireScripts
    @vite(['resources/js/affiliate.js'])
</body>
</html>
<x-layouts.default :title="$title ?? config('app.name')">
    <x-header />
    <div class="tf-page-title style-2">
        <div class="container-full">
            <div class="heading text-center">{{ $title ?? config('app.name') }}</div>
        </div>
    </div>
    {{ $slot }}
</x-layouts.default>
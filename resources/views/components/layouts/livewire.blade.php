<x-layouts.main :title="$title ?? config('app.name')">
    <x-header />
    <div class="tf-page-title style-2 tw:-mt-16 tw:-mb-8">
        <div class="container-full">
            <div class="heading text-center">{{ $title ?? config('app.name') }}</div>
        </div>
    </div>
    {{ $slot }}
</x-layouts.main>
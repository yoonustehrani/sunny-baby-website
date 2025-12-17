<x-layouts.main :title="__('Search')">
    <x-header />
    <div class="tf-page-title style-2">
        <div class="container-full">
            <div class="heading text-center">@lang("Search"): «{{ request()->query('term') }}»</div>
        </div>
    </div>
    <section class="flat-spacing-1">
        <div class="container-full">
            <div class="grid-layout wrapper-shop" data-grid="grid-6">
                @foreach ($products as $product)
                    <x-cards.product-card 
                        wire:key='pr-result-{{ $product->id }}' 
                        :$product 
                        class="tw:bg-white! tw:p-2! tw:rounded-xl style-4 tw:flex-col"
                    />
                @endforeach
            </div>
        </div>
    </section>
</x-layouts.main>
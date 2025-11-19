<x-layouts.main :$title>
    <x-topbar />
    <x-header />
    <x-sections.slider />
    {{-- <x-sections.categories /> --}}
    <livewire:new-arrivals-section lazy/>
    {{-- <livewire:category-products-row :category="$categories[0]" lazy/> --}}
    {{-- <x-sections.brands :$brands/> --}}
    {{-- <livewire:category-products-row :category="$categories[1]" lazy/> --}}
    {{-- <x-sections.sex :attribute="$attributes['sex']"/> --}}
    {{-- <livewire:category-products-row :category="$categories[2]" lazy/> --}}
    {{-- <x-sections.colors :attribute="$attributes['color']"/> --}}
</x-layouts.main>
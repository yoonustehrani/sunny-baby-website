<x-layout title="سانی بی بی">
    <x-topbar />
    <x-header />
    <x-sections.slider />
    <x-sections.categories />
    <livewire:new-arrivals-section lazy/>
    <livewire:category-products-row :category="$categories[0]" lazy/>
    <x-sections.brands />
    <livewire:category-products-row :category="$categories[1]" lazy/>
    <x-sections.sex />
    <livewire:category-products-row :category="$categories[2]" lazy/>
    <x-sections.colors />
</x-layout>

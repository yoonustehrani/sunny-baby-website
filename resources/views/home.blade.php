<x-layout title="Ecomus - Ultimate HTML">
    <x-topbar />
    <x-header />
    <x-sections.slider />
    @php
        $categories = [
            'پوشاک نوزاد',
            'غذاخوری نوزاد',
            'کالای خواب نوزاد',
            'محصولات بهداشتی،‌ مراقبتی، حمام',
            'ملزومات سفر و گردش'
        ];
    @endphp
    <x-sections.categories />
    <x-sections.new-arrivals />
    <x-sections.product-row :title="$categories[0]"/>
    <x-sections.brands />
    <x-sections.product-row :title="$categories[1]"/>
    <x-sections.sex />
    <x-sections.product-row :title="$categories[2]"/>
    <x-sections.colors />
</x-layout>
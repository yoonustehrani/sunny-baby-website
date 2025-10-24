<section class="flat-spacing-1 tw:bg-white">
    <div class="container" x-data="{ open: false }">
        <div class="tf-shop-control grid-3 align-items-center">
            <div class="tw:md:block tw:hidden"></div>
            <div class="tf-control-filter tw:block tw:md:hidden">
                <button type="button" class="tf-btn-filter d-md-none mb-3"  x-on:click='open = true'>
                    <span class="icon icon-filter"></span><span class="text">@lang('Filter')</span>
                </button>
            </div>
            <ul class="tf-control-layout d-flex justify-content-center">
                <li class="tf-view-layout-switch sw-layout-2" data-value-grid="grid-2">
                    <div class="item"><span class="icon icon-grid-2"></span></div>
                </li>
                <li class="tf-view-layout-switch sw-layout-3" data-value-grid="grid-3">
                    <div class="item"><span class="icon icon-grid-3"></span></div>
                </li>
                <li class="tf-view-layout-switch sw-layout-4 active" data-value-grid="grid-4">
                    <div class="item"><span class="icon icon-grid-4"></span></div>
                </li>
                <li class="tf-view-layout-switch sw-layout-5" data-value-grid="grid-5">
                    <div class="item"><span class="icon icon-grid-5"></span></div>
                </li>
                <li class="tf-view-layout-switch sw-layout-6" data-value-grid="grid-6">
                    <div class="item"><span class="icon icon-grid-6"></span></div>
                </li>
            </ul>
            <div class="tf-control-sorting d-flex justify-content-end">
                <div class="tf-dropdown-sort" data-bs-toggle="dropdown">
                    <div class="btn-select">
                        <span class="text-sort-value">{{ $orderBy ? __($orderList[$orderBy]) : __('Featured') }}</span>
                        <span class="icon icon-arrow-down"></span>
                    </div>
                    <div class="dropdown-menu">
                        @foreach ($orderList as $key => $item)
                            <div @class(["select-item", "active" => $orderBy === $key || (is_null($orderBy) && $loop->first)]) wire:click.prevent="setOrderBy('{{ $key }}')" wire:key='{{ $key }}'> 
                                <span class="text-value-item tw:text-right tw:block tw:w-full">{{ $item }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="blog-sidebar-main p-0">
            <div 
                x-bind:class="open ? 'tw:translate-x-0' : 'tw:-translate-x-full tw:md:translate-x-0'"
                class="tw:fixed tw:h-full tw:overflow-y-auto tw:md:static tw:inset-y-0 tw:left-0 tw:z-[99999] tw:w-70 tw:bg-white tw:shadow-lg tw:transform tw:transition-transform tw:duration-300 tw:md:translate-x-0 tw:md:shadow-none tw:md:w-fit tw:p-4 tw:rounded-r-xl"
            {{-- class=" filters-active tw:hidden tw:md:flex flex-shrink-0" --}}
            >
                <div class="tw:flex tw:md:hidden tw:items-center tw:justify-between tw:px-2 tw:py-4 tw:border-b-2 tw:border-gray-100 tw:mb-4">
                    <div class="filter-icon">
                        <span class="icon icon-filter"></span>
                        <span>@lang('Filter')</span>
                    </div>
                    <span class="icon-close icon-close-popup" x-on:click='open = false'></span>
                </div>
                <div class="widget-facet wd-categories">
                    <div class="facet-title" data-bs-target="#categories" data-bs-toggle="collapse" aria-expanded="true"
                        aria-controls="categories">
                        <span>@lang('Product categories')</span>
                        <span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="categories" class="collapse show">
                        <ul class="list-categoris current-scrollbar mb_36">
                            @foreach($categories as $category)
                                <li class="tw:font-normal">
                                    <x-shop.category-filter-item :$category :level="0"/>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div id="facet-filter-div" class="facet-filter-div">
                    <div class="widget-facet">
                        <div class="facet-title" data-bs-target="#availability" data-bs-toggle="collapse"
                            aria-expanded="true" aria-controls="availability">
                            <span>@lang('Availability')</span>
                            <span class="icon icon-arrow-up"></span>
                        </div>
                        <div id="availability" class="collapse show">
                            <ul class="tf-filter-group current-scrollbar mb_36">
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input wire:model.live='onlyInStock' type="checkbox" name="availability" class="tf-check" id="availability-1">
                                    <label for="availability-1" class="label">
                                        <span>@lang('In stock')</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="widget-facet">
                        <div class="facet-title" data-bs-target="#brand" data-bs-toggle="collapse" aria-expanded="true"
                            aria-controls="brand">
                            <span>@lang('Brand')</span>
                            <span class="icon icon-arrow-up"></span>
                        </div>
                        <div id="brand" class="collapse show">
                            <ul class="tf-filter-group current-scrollbar mb_36">
                                @foreach ($brands as $item)
                                    <li class="list-item d-flex gap-12 align-items-center">
                                        <input type="radio" name="brand" wire:model.live='brand' value="{{ $item->getKey() }}" class="tf-check" id="brand-{{ $item->getKey() }}">
                                        @if ($item->image)
                                            <img src="{{ asset($item->image->thumbnail_url) }}" height="30px" class="tw:w-auto tw:h-4">
                                        @endif
                                        <label @if($brand == $item->id) wire:click='unsetBrand' @endif for="brand-{{ $item->getKey() }}" class="label"><span>{{ $item->name }}</span>&nbsp;<span>({{ $item->results_count }})</span></label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @foreach ($attributes as $attribute)
                        <x-shop.attribute-filters :$attribute :counts='$optionCounts'/>
                    @endforeach
                </div>
            </div>
            <div class="tw:w-full">
                @if ($products->count() > 0)
                    <div class="grid-layout wrapper-shop" data-grid="grid-4">
                        @foreach ($products as $product)
                            <x-cards.product-card 
                                wire:key='pr-result-{{ $product->id }}' 
                                :$product 
                                class="tw:bg-white! tw:p-2! tw:rounded-xl style-4 tw:flex-col"
                            />
                        @endforeach
                    </div>
                    <div class="tf-pagination-wrap tw:flex tw:items-center tw:justify-center tw:w-full">
                        {{ $products->links() }}
                    </div>
                @else
                    <p class="tw:text-2xl tw:text-center tw:p-4">محصولی برای نمایش موجود نیست.</p>
                @endif
            </div>
        </div>
    </div>
</section>
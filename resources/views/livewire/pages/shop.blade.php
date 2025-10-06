<section class="flat-spacing-1 tw:bg-white">
    <div class="container">
        <div class="tf-shop-control grid-3 align-items-center">
            <div></div>
            <!-- <div class="tf-control-filter">
                        <a href="#filterShop" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft" class="tf-btn-filter"><span class="icon icon-filter"></span><span class="text">Filter</span></a>
                    </div> -->
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
            <div class="tf-section-sidebar wrap-sidebar-mobile flex-shrink-0">
                <div class="widget-facet wd-categories">
                    <div class="facet-title" data-bs-target="#categories" data-bs-toggle="collapse" aria-expanded="true"
                        aria-controls="categories">
                        <span>Product categories</span>
                        <span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="categories" class="collapse show">
                        <ul class="list-categoris current-scrollbar mb_36">
                            <li class="cate-item current"><a href="shop-filter-sidebar.html#"><span>Fashion</span></a>
                            </li>
                            <li class="cate-item"><a href="shop-filter-sidebar.html#"><span>Men</span></a></li>
                            <li class="cate-item"><a href="shop-filter-sidebar.html#"><span>Women</span></a></li>
                            <li class="cate-item"><a href="shop-filter-sidebar.html#"><span>Denim</span></a></li>
                            <li class="cate-item"><a href="shop-filter-sidebar.html#"><span>Dress</span></a></li>
                        </ul>
                    </div>
                </div>
                <form action="shop-filter-sidebar.html#" id="facet-filter-form" class="facet-filter-form">
                    <div class="widget-facet">
                        <div class="facet-title" data-bs-target="#availability" data-bs-toggle="collapse"
                            aria-expanded="true" aria-controls="availability">
                            <span>@lang('Availability')</span>
                            <span class="icon icon-arrow-up"></span>
                        </div>
                        <div id="availability" class="collapse show">
                            <ul class="tf-filter-group current-scrollbar mb_36">
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="checkbox" name="availability" class="tf-check" id="availability-1">
                                    <label for="availability-1" class="label">
                                        <span>@lang('In stock')</span>&nbsp;<span>(14)</span>
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
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="brand" class="tf-check" id="brand-1">
                                    <label for="brand-1" class="label"><span>Ecomus</span>&nbsp;<span>(8)</span></label>
                                </li>
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="brand" class="tf-check" id="brand-2">
                                    <label for="brand-2" class="label"><span>M&H</span>&nbsp;<span>(8)</span></label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @foreach ($attributes as $attribute)
                        <x-shop.attribute-filters :$attribute :counts='$optionCounts'/>
                    @endforeach
                </form>
            </div>
            <div class="tw:w-full">
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
                    {{-- <ul class="wg-pagination justify-content-center">
                        <li class="active">
                            <div class="pagination-item">1</div>
                        </li>
                        <li>
                            <a href="shop-filter-sidebar.html#" class="pagination-item animate-hover-btn">2</a>
                        </li>
                        <li>
                            <a href="shop-filter-sidebar.html#" class="pagination-item animate-hover-btn">3</a>
                        </li>
                        <li>
                            <a href="shop-filter-sidebar.html#" class="pagination-item animate-hover-btn"><i
                                    class="icon-arrow-right"></i></a>
                        </li>
                    </ul> --}}
                </div>
            </div>
        </div>
    </div>
</section>
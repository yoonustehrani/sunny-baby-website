<div class="list-product-btn gap-0 {{ $class ?? '' }}">
    <a href="#quick_add" data-bs-toggle="modal" class="box-icon bg_white quick-add tf-btn-loading shadow-none">
        <span class="icon icon-bag"></span>
        <span class="tooltip">@lang('Quick Add')</span>
    </a>
    <a href="javascript:void(0);" class="box-icon bg_white wishlist btn-icon-action shadow-none">
        <span class="icon icon-heart"></span>
        <span class="tooltip">@lang('Add to Wishlist')</span>
        <span class="icon icon-delete"></span>
    </a>
    <a href="#compare" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft" class="box-icon bg_white compare btn-icon-action shadow-none">
        <span class="icon icon-compare"></span>
        <span class="tooltip">@lang('Add to Compare')</span>
        <span class="icon icon-check"></span>
    </a>
    <a href="#quick_view" data-bs-toggle="modal" class="box-icon bg_white quickview tf-btn-loading shadow-none">
        <span class="icon icon-view"></span>
        <span class="tooltip">@lang('Quick View')</span>
    </a>
</div>
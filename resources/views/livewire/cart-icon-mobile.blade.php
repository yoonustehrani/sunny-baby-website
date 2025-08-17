<a href='#cart' type="button" type="button" x-on:click='$("#shoppingCart").modal("show");'>
    <div class="toolbar-icon">
        <i class="icon-bag"></i>
        <div class="toolbar-count">{{ $count }}</div>
    </div>
    <div class="toolbar-label">@lang('Cart')</div>
</a>
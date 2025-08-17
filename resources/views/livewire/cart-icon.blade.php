<li class="nav-cart">
    {{--  --}}
    <button type="button" data-bs-toggle="modal" x-on:click='$("#shoppingCart").modal("show");' class="nav-icon-item"><i class="icon icon-bag"></i>
        <span class="count-box">{{ $count }}</span>
    </button>
</li>
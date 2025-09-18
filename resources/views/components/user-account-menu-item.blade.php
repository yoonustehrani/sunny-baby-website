<li>
    @if ($active)
        <span class="my-account-nav-item active">{{ $text }}</span>
    @else
        <a href="{{ $url }}" class="my-account-nav-item">{{ $text }}</a>
    @endif
</li>
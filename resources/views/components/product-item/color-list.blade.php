<ul class="list-color-product">
    @foreach ($colors as $color)
    <li class="list-color-item color-swatch {{ $loop->index == 0 ? 'active' : '' }}">
        <span class="tooltip">{{ $color['name'] }}</span>
        <span class="swatch-value {{ $color['class'] }}"></span>
        <img class="lazyload" data-src="{{ asset($color['img']) }}" src="{{ asset($color['thumbnail']) }}" alt="image-product">
    </li>
    @endforeach
</ul>
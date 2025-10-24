<div class="widget-facet">
    <div class="facet-title" data-bs-target="#attr-filter-{{ md5($attribute->label) }}" data-bs-toggle="collapse" aria-expanded="true"
        aria-controls="color">
        <span>{{ $attribute->label }}</span>
        <span class="icon icon-arrow-up"></span>
    </div>
    @if ($attribute->options->count())
        <div id="attr-filter-{{ md5($attribute->label) }}" class="collapse show">
            <ul class="tf-filter-group filter-color current-scrollbar mb_36">
                @foreach ($attribute->options as $option)
                    <li class="list-item">
                        <label for="attr-op-{{ $option->id }}" class="label d-flex align-items-center tw:gap-2">
                        @switch($attribute->option_content_type)
                            @case(App\Enums\OptionContentType::COLOR)
                                <input wire:change.live='toggleFilter({{ $attribute->id }}, {{ $option->id }})' type="checkbox" name="{{ $attribute->id }}" class="tf-check-color" style="background-color: {{ $option->content }};" id="attr-op-{{ $option->id }}">
                                @break
                            @case(App\Enums\OptionContentType::IMAGE)
                                <input wire:change.live='toggleFilter({{ $attribute->id }}, {{ $option->id }})' type="checkbox" name="{{ $attribute->id }}" class="tf-check" id="attr-op-{{ $option->id }}">
                                <img height="40" width="40" src="{{ asset($option->content) }}" alt="{{ $attribute->label }} - {{ $option->label }}">
                                @break
                            @default
                                <input wire:change.live='toggleFilter({{ $attribute->id }}, {{ $option->id }})' type="checkbox" name="{{ $attribute->id }}" class="tf-check" id="attr-op-{{ $option->id }}">
                        @endswitch
                        <span @class(['tw:text-primary' => $this->isFilterSelected($attribute->id, $option->id)])>{{ $option->label }}&nbsp;<span>({{ $counts[$option->id] }})</span></span>
                        </label>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
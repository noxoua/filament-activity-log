@php
    use Filament\Support\Contracts\HasColor;
    use Filament\Support\Contracts\HasLabel;
    use Filament\Support\Contracts\HasIcon;
@endphp

<div class="flex flex-wrap gap-2">
    @if (is_array($value))
        @foreach ($value as $label)
            <x-filament::badge
                :color="$field->badgeColor"
                class="w-fit"
            >
                {{ $label }}
            </x-filament::badge>
        @endforeach
    @elseif($field->is('enum'))
        @php
            $label = $value instanceof HasLabel ? $value->getLabel() : $value;
            $color = $value instanceof HasColor ? $value->getColor() : $field->badgeColor;
            $icon = $value instanceof HasIcon ? $value->getIcon() : null;
        @endphp

        <x-filament::badge
            :color="$color"
            :icon="$icon"
            class="w-fit"
        >
            {{ $label }}
        </x-filament::badge>
    @else
        <x-filament::badge
            :color="$field->badgeColor"
            class="w-fit"
        >
            {{ $value }}
        </x-filament::badge>
    @endif

</div>

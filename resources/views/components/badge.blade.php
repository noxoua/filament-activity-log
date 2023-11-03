@php
    use Filament\Support\Contracts\HasColor;
    use Filament\Support\Contracts\HasLabel;
    use Filament\Support\Contracts\HasIcon;
@endphp

<div class="flex flex-wrap gap-2">
    @if (is_string($value) || $field->is('enum'))
        @php
            if (is_string($value)) {
                $label = $value;
                $color = $field->badgeColor;
                $icon = null;
            } else {
                $label = $value instanceof HasLabel ? $value->getLabel() : $value;
                $color = $value instanceof HasColor ? $value->getColor() : $field->badgeColor;
                $icon = $value instanceof HasIcon ? $value->getIcon() : null;
            }
        @endphp

        <x-filament::badge
            :color="$color"
            :icon="$icon"
            class="w-fit"
        >
            {{ $label }}
        </x-filament::badge>
    @elseif(is_array($value))
        @foreach ($value as $label)
            <x-filament::badge
                :color="$field->badgeColor"
                class="w-fit"
            >
                {{ $label }}
            </x-filament::badge>
        @endforeach
    @endif
</div>

@props(['value'])


<div class="flex flex-wrap gap-2">
    @if (is_string($value) || $value instanceof \UnitEnum)
        @php
            if (is_string($value)) {
                $color = 'primary';
                $label = $value;
                $icon = null;
            } else {
                $color = $value?->getColor() ?? 'primary';
                $label = $value?->getLabel() ?? $value;
                $icon = $value?->getIcon();
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
                color="primary"
                class="w-fit"
            >
                {{ $label }}
            </x-filament::badge>
        @endforeach
    @endif
</div>

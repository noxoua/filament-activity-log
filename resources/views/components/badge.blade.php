@props(['value'])


<div class="flex flex-wrap gap-2">
    @if (is_string($value) || $value instanceof \UnitEnum)
        @php
            if (is_string($value)) {
                $color = 'primary';
                $label = $value;
            } else {
                $color = $value?->getColor() ?? 'primary';
                $label = $value?->getLabel() ?? $value;
            }
        @endphp

        <x-filament::badge
            :color="$color"
            class="w-fit"
        >
            {{ $label }}
        </x-filament::badge>
    @elseif(is_array($value))
        @foreach ($value as $_value)
            {{ view('filament-activity-log::components.badge', [
                'value' => $_value,
            ]) }}
        @endforeach
    @endif
</div>

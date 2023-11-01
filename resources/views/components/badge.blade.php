@props(['value', 'rawValue', 'typeName', 'typeValues'])

@php
    $getRawValue = fn($key) => ((array) $rawValue)[$key];
@endphp

<div class="flex flex-wrap gap-2">
    @foreach ((array) $value as $key => $_value)
        @php
            $color = 'primary';
            if ($typeName === 'enum') {
                $enum = $this->resolveEnumFromName($typeValues[0], $getRawValue($key));
                $color = $enum?->getColor() ?? 'primary';
            } elseif ($typeName === 'boolean') {
                $color = $_value === 'true' ? 'success' : 'danger';
            }
        @endphp

        <x-filament::badge
            :color="$color"
            class="w-fit"
        >
            {{ $_value }}
        </x-filament::badge>
    @endforeach
</div>

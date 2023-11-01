@props(['activityItem', 'field', 'value'])

@php
    $view = $this->getFieldView($activityItem, $field);
    [$typeName, $typeValues] = $this->getFieldType($activityItem, $field);

    $rawValue = $value;
    $getRawValue = fn($key) => ((array) $rawValue)[$key];

    $value = $this->resolveValueByType($typeName, $typeValues, $rawValue);
@endphp

@switch($view)
    @case('avatar')
        @if (is_string($value))
            <x-filament::avatar
                :src="$value"
                size="lg"
                class="rounded-full"
            />
        @endif
    @break

    @case('image')
        <div class="flex flex-wrap gap-2">
            @foreach ((array) $value as $_value)
                <x-filament::avatar
                    :src="$_value"
                    size="lg"
                    class="rounded-md"
                />
            @endforeach
        </div>
    @break

    @case('badge')
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
    @break

    @default
        @if (is_array($value))
            <pre class="text-xs text-gray-500">{{ json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) }}</pre>
        @else
            {{ $value }}
        @endif
@endswitch

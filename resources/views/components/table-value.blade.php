@props(['activityItem', 'field', 'value'])

@php
    $view = $this->getFieldView($activityItem, $field);
    $type = $this->getFieldType($activityItem, $field);
@endphp

@switch($view)
    @case('avatar')
        <x-filament::avatar
            :src="$value"
            size="lg"
            class="rounded-full"
        />
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
            @foreach ((array) $value as $_value)
                @php
                    $color = 'primary';
                    if ($type === 'boolean') {
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

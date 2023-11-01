@props(['value'])

@if (is_string($value))
    <x-filament::avatar
        :src="$value"
        size="lg"
        class="rounded-full"
    />
@endif

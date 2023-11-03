<div class="flex flex-wrap gap-2">
    @foreach ((array) $value as $_value)
        <x-filament::avatar
            :src="$_value"
            size="lg"
            :class="$field->rounded === 'circle' ? 'rounded-full' : 'rounded-md'"
        />
    @endforeach
</div>

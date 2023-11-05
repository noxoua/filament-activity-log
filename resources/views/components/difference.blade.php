<div
    x-data='{
        oldVal: {{ $oldValue }},
        newVal: {{ $newValue }},
        method: "{{ $options['method'] ?? 'diffWords' }}",
        options: @json($options['options'] ?? []),
    }'
    x-html="getStringsDifference(oldVal, newVal, method, options)"
>
</div>

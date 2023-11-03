@if (is_array($value))
    <pre class="text-xs text-gray-500">{{ json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) }}</pre>
@else
    {{ $value }}
@endif

@php
    $isHtmlAllowed = $field->isHtmlAllowed();
@endphp

@if (is_array($value))
    <pre class="text-xs text-gray-500">
        @if ($isHtmlAllowed)
{!! json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
@else
{{ json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) }}
@endif
    </pre>
@else
    @if ($isHtmlAllowed)
        {!! $value !!}
    @else
        {{ $value }}
    @endif
@endif

@props(['activity', 'field', 'rawValue'])

@php
    $view = $this->getFieldView($activity, $field) ?? 'default';
    $value = $this->resolveValue($activity, $field, $rawValue);

    if ($value instanceof \UnitEnum) {
        $view = 'badge';
    }
@endphp

{{ view('filament-activity-log::components.' . $view, compact('value')) }}

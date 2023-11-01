@props(['activity', 'field', 'rawValue'])

@php
    $view = $this->getFieldView($activity, $field) ?? 'default';
    //[$typeName, $typeValues] = $this->getFieldType($activity, $field);
    $value = $this->resolveValue($activity, $field, $rawValue);
@endphp

{{ view('filament-activity-log::components.' . $view, compact('value', 'rawValue')) }}

<?php

namespace Noxo\FilamentActivityLog\Fields\Concerns;

trait Displayable
{
    public function getLabel(): mixed
    {
        $key = $this->translatedKey ?? $this->name;

        return __("filament-activity-log::activities.attributes.{$key}");
    }

    public function display(mixed $value): mixed
    {
        $value = match ($this->type) {
            'datetime' => $this->formatDatetime($value),
            'enum' => $this->resolveEnum($value),
            'associative_array' => (array) $value,
            'money' => $this->formatMoney((float) $value),
            default => $value,
        };

        $view = is_null($value) ? 'default' : $this->view;

        return view('filament-activity-log::components.' . $view, [
            'value' => $value,
            'field' => $this,
        ]);
    }
}

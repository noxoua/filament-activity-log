<?php

namespace Noxo\FilamentActivityLog\Fields\Concerns;

trait Displayable
{
    public function getLabel(): mixed
    {
        if (filled($this->label)) {
            return $this->label;
        }

        return __("filament-activity-log::activities.attributes.{$this->name}");
    }

    public function display(mixed $value): mixed
    {
        $value = match ($this->type) {
            'datetime' => $this->formatDatetime($value),
            'enum' => $this->resolveEnum($value),
            'key-value' => (array) $value,
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

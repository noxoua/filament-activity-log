<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns;

trait CanDisplay
{
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

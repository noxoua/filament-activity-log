<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns;

trait CanDisplay
{
    public function display(mixed $value, bool $raw = false): mixed
    {
        if ($this->formatStateCallback) {
            $value = call_user_func($this->formatStateCallback, $value);
        }

        if ($raw) {
            return $value;
        }

        $view = is_null($value) ? 'default' : $this->view;

        return view('filament-activity-log::components.' . $view, [
            'value' => $value,
            'field' => $this,
        ]);
    }
}

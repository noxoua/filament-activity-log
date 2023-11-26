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

        $template = is_null($value) ? 'default' : $this->template;
        $view = $this->view ?? 'filament-activity-log::components.' . $template;

        return view($view, ['value' => $value, 'field' => $this]);
    }
}

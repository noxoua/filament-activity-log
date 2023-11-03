<?php

namespace Noxo\FilamentActivityLog\Fields\Concerns;

trait HasLabel
{
    public ?string $label = null;

    public function label(string $key): static
    {
        $this->label = $key;

        return $this;
    }

    public function getLabel(): mixed
    {
        if (filled($this->label)) {
            return $this->label;
        }

        return (string) str($this->name)
            ->kebab()
            ->replace(['-', '_'], ' ')
            ->ucfirst();
    }
}

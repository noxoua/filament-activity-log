<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns;

trait HasLabel
{
    public ?string $label = null;

    public function label(string $label): static
    {
        $this->label = $label;

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

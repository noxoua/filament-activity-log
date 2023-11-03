<?php

namespace Noxo\FilamentActivityLog\Fields\Concerns;

trait HasName
{
    public string $name;

    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}

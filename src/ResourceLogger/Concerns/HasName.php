<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns;

trait HasName
{
    public string $name;

    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}

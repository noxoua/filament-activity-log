<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns;

trait HasType
{
    public ?string $type = null;

    public mixed $options = null;

    public function is(string $type): bool
    {
        return $this->type === $type;
    }

    public function type(string $type, mixed $options = null): static
    {
        $this->type = $type;
        $this->options = $options;

        return $this;
    }
}

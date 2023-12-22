<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns\Types;

trait Inline
{
    public bool $inline = false;

    public function inline(): static
    {
        $this->inline = true;

        return $this;
    }

    public function isInline(): bool
    {
        return $this->inline;
    }
}

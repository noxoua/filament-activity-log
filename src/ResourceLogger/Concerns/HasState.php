<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns;

use Closure;

trait HasState
{
    public ?Closure $resolveStateCallback = null;

    public ?Closure $formatStateCallback = null;

    public function resolveStateUsing(Closure $callback): static
    {
        $this->resolveStateCallback = $callback;

        return $this;
    }

    public function formatStateUsing(Closure $callback): static
    {
        $this->formatStateCallback = $callback;

        return $this;
    }
}

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

    public function formatStateUsing(string | Closure $callback): static
    {
        if (is_string($callback)) {
            $callback = match ($callback) {
                'array' => fn ($state): array => (array) $state,
                'string' => fn ($state): string => (string) $state,
                'bool' => fn ($state): bool => (bool) $state,
                'int' => fn ($state): int => (int) $state,
                'float' => fn ($state): float => (float) $state,
                'json' => fn ($state): string => json_encode($state ?? ''),
                default => fn ($state) => $state,
            };
        }

        $this->formatStateCallback = $callback;

        return $this;
    }
}

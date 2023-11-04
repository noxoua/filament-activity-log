<?php

namespace Noxo\FilamentActivityLog\Loggers\Concerns;

use Illuminate\Contracts\Support\Htmlable;

trait HasLabel
{
    public static function getLabel(): string | Htmlable | null
    {
        /** @var \Noxo\FilamentActivityLog\Loggers\Logger $this */
        return (string) str(static::$model)
            ->afterLast('\\')
            ->kebab()
            ->replace(['-', '_'], ' ')
            ->ucfirst();
    }
}

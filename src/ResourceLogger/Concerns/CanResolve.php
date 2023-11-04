<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns;

use Closure;

trait CanResolve
{
    public ?Closure $resolveCallback = null;

    public function resolveFromString(string $string): static
    {
        if (str_contains($string, ':')) {
            [$type, $options] = explode(':', $string);
        } else {
            [$type, $options] = [$string, null];
        }

        $list = [
            'boolean',
            'badge',
            'date',
            'money',
            'label',
            'media',
            'relation',
        ];

        if (in_array($type, $list)) {
            $this->{$type}($options);
        }

        return $this;
    }

    public function resolveUsing(Closure $callback): static
    {
        $this->resolveCallback = $callback;

        return $this;
    }
}

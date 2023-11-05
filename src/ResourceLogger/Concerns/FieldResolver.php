<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns;

trait FieldResolver
{
    public function resolveField(string $string): static
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
}

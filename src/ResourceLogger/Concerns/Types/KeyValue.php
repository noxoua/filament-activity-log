<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns\Types;

trait KeyValue
{
    public bool $keyValueDifferenceOnly = true;

    public function keyValue(bool $differenceOnly = true): static
    {
        $this->type('key-value');
        $this->view('key-value');
        $this->keyValueDifferenceOnly = $differenceOnly;

        return $this;
    }

    public function resolveKeyValueDifference(mixed $array1, mixed $array2): array
    {
        if (! is_array($array1) || ! is_array($array2)) {
            return [$array1, $array2];
        }

        foreach ($array1 as $key1 => $row1) {
            foreach ($array2 as $key2 => $row2) {
                if ($row1 === $row2) {
                    unset($array1[$key1]);
                    unset($array2[$key2]);
                }
            }
        }

        return [$array1, $array2];
    }
}

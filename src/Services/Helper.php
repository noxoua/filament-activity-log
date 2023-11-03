<?php

namespace Noxo\FilamentActivityLog\Services;

use UnitEnum;

final class Helper
{
    public static function resolveEnum(string $enum, ?string $name): ?UnitEnum
    {
        foreach ($enum::cases() as $unit) {
            if (strtolower($name) === strtolower($unit->name)) {
                return $unit;
            }
        }

        return null;
    }
}

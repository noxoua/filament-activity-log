<?php

namespace Noxo\FilamentActivityLog\Services;

use Illuminate\Database\Eloquent\Model;
use Noxo\FilamentActivityLog\Loggers\Logger;
use Noxo\FilamentActivityLog\Loggers\Loggers;
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

    /**
     * @return class-string<Logger>
     */
    public static function resolveLogger(null | string | Model $record, bool $force = false): ?string
    {
        if (! $record) {
            return null;
        }

        $name = is_string($record) ? $record : get_class($record);

        return Loggers::getLoggerByModel($name, $force);
    }

    public static function resolveInlineField($logger, array $attributes, array $old = []): ?array
    {
        foreach ($attributes as $key => $newValue) {
            $field = $logger->getFieldByName($key);
            if (! $field) {
                continue;
            }

            $oldValue = $old[$key] ?? null;

            if ($field->isInline()) {
                return [$field, $oldValue, $newValue];
            }
        }

        return null;
    }
}

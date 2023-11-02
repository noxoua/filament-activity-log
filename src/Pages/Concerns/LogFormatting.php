<?php

namespace Noxo\FilamentActivityLog\Pages\Concerns;

use function Filament\Support\format_money;
use Noxo\FilamentActivityLog\ActivityLoggers;
use Noxo\FilamentActivityLog\Types\BooleanEnum;
use Spatie\Activitylog\Models\Activity;

trait LogFormatting
{
    /**
     * Get the label for the subject of the activity.
     */
    public function getSubjectLabel(Activity $activity): string
    {
        $subjectType = strtolower(class_basename($activity->subject_type));

        return __('filament-activity-log::activities.subjects.' . $subjectType);
    }

    /**
     * Get the label for a specific field of the activity.
     */
    public function getFieldLabel(Activity $activity, string $field): string
    {
        $loggerClass = ActivityLoggers::getLoggerByModelClass($activity->subject_type);

        // Check if the field has a custom mapping, otherwise use the original field name.
        $field = $loggerClass::$attributeMap[$field] ?? $field;

        return __("filament-activity-log::activities.attributes.{$field}");
    }

    /**
     * Get the view for a specific field of the activity.
     */
    public function getFieldView(Activity $activity, string $field): ?string
    {
        $loggerClass = ActivityLoggers::getLoggerByModelClass($activity->subject_type);

        return $loggerClass::$views[$field] ?? null;
    }

    public function resolveEnumFromName(string $enum, ?string $name): ?\UnitEnum
    {
        foreach ($enum::cases() as $unit) {
            if (strtolower($name) === strtolower($unit->name)) {
                return $unit;
            }
        }

        return null;
    }

    /**
     * Get the type-specific value for a field.
     */
    public function resolveValue($activity, $field, $rawValue): mixed
    {
        $loggerClass = ActivityLoggers::getLoggerByModelClass($activity->subject_type);

        $typeString = $loggerClass::$types[$field] ?? null;
        if (empty($typeString)) {
            return $rawValue;
        }

        if (str_contains($typeString, ':')) {
            [$type, $typeArgument] = explode(':', $typeString);
        } else {
            $type = $typeString;
            $typeArgument = null;
        }

        switch ($type) {
            case 'date':
            case 'time':
            case 'datetime':
                try {
                    $value = \Carbon\Carbon::parse($rawValue);

                    return $value?->translatedFormat($typeArgument ?? match ($type) {
                        'date' => 'Y-m-d',
                        'time' => 'H:i:s',
                        'datetime' => 'Y-m-d H:i:s',
                    });
                } catch (\Exception $e) {
                }
            case 'boolean':
                return $this->resolveEnumFromName(BooleanEnum::class, $rawValue);
            case 'enum':
                return $this->resolveEnumFromName($typeArgument, $rawValue);
            case 'associative_array':
                return (array) $rawValue;
            case 'money':
                return format_money(
                    (float) $rawValue, $typeArgument ?? 'EUR'
                );
        }

        return $rawValue;
    }
}

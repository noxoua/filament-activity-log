<?php

namespace Noxo\FilamentActivityLog\Pages\Concerns;

use Noxo\FilamentActivityLog\ActivityLoggers;
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

    /**
     * Get the type of a specific field of the activity.
     */
    public function getFieldType(Activity $activity, string $field): array
    {
        $loggerClass = ActivityLoggers::getLoggerByModelClass($activity->subject_type);

        $typeName = $loggerClass::$types[$field] ?? null;
        if (empty($typeName)) {
            return [null, null];
        }

        $res = explode(':', $typeName);
        $type = $res[0];
        $values = array_filter(explode(',', $res[1] ?? null));

        return [$type, $values];

    }

    public function resolveEnumFromName(string $enum, string $name): \UnitEnum|null
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
    public function resolveValueByType($typeName, $typeValues, $fieldValue): mixed
    {
        switch ($typeName) {
            // TODO:
            // case 'date':
            //     return parse_timestamp($value)?->translatedFormat($typeValues[0] ?? 'Y-m-d');

            // case 'time':
            //     return parse_timestamp($value)?->translatedFormat($typeValues[0] ?? 'H:i:s');

            // case 'datetime':
            //     return parse_timestamp($value)?->translatedFormat($typeValues[0] ?? 'Y-m-d H:i:s');

            case 'enum':
                $enum = $this->resolveEnumFromName($typeValues[0], $fieldValue);
                return $enum?->getLabel();
        }

        return $fieldValue;
    }
}

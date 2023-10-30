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
    public function getFieldType(Activity $activity, string $field): ?string
    {
        $loggerClass = ActivityLoggers::getLoggerByModelClass($activity->subject_type);

        return $loggerClass::$types[$field] ?? null;
    }
}

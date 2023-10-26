<?php

namespace Noxo\FilamentActivityLog\Pages\Concerns;

use Spatie\Activitylog\Models\Activity;

trait LogFormatting
{
    /**
     * Get the label for the subject of the activity.
     *
     * @param Activity $activity
     *
     * @return string
     */
    public function getSubjectLabel(Activity $activity): string
    {
        $subjectType = strtolower(class_basename($activity->subject_type));
        return __('filament-activity-log::activities.subjects.' . $subjectType);
    }

    /**
     * Get the label for a specific field of the activity.
     *
     * @param Activity $activity
     * @param string $field
     *
     * @return string
     */
    public function getFieldLabel(Activity $activity, string $field): string
    {
        $loggerClass = $this->loggers[$activity->subject_type];

        // Check if the field has a custom mapping, otherwise use the original field name.
        $field = $loggerClass::$attributeMap[$field] ?? $field;

        return __("filament-activity-log::activities.attributes.{$field}");
    }

    /**
     * Get the view for a specific field of the activity.
     *
     * @param Activity $activity
     * @param string $field
     *
     * @return string|null
     */
    public function getFieldView(Activity $activity, string $field): ?string
    {
        $loggerClass = $this->loggers[$activity->subject_type];
        return $loggerClass::$fieldViews[$field] ?? null;
    }

    /**
     * Get the type of a specific field of the activity.
     *
     * @param Activity $activity
     * @param string $field
     *
     * @return string|null
     */
    public function getFieldType(Activity $activity, string $field): ?string
    {
        $loggerClass = $this->loggers[$activity->subject_type];
        return $loggerClass::$types[$field] ?? null;
    }
}

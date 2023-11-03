<?php

namespace Noxo\FilamentActivityLog\Pages\Concerns;

use Noxo\FilamentActivityLog\Fields\Field;
use Noxo\FilamentActivityLog\Fields\Fields;
use Noxo\FilamentActivityLog\Loggers\Loggers;
use Spatie\Activitylog\Models\Activity;

trait LogFormatting
{
    public function getSubjectLabel(Activity $activity): string
    {
        $logger = Loggers::getLoggerByModel($activity->subject_type);

        return $logger::getLabel();
    }

    public function getField(Activity $activity, string $name): ?Field
    {
        $logger = Loggers::getLoggerByModel($activity->subject_type);

        return $logger::fields(new Fields)->getFieldByName($name);
    }
}

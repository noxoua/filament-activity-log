<?php

namespace Noxo\FilamentActivityLog\Pages\Concerns;

use Noxo\FilamentActivityLog\Loggers\Logger;
use Noxo\FilamentActivityLog\Loggers\Loggers;
use Spatie\Activitylog\Models\Activity;

trait HasLogger
{
    public function getLogger(Activity $activity): Logger
    {
        $logger = Loggers::getLoggerByModel($activity->subject_type);
        $loggerInstance = $logger::make();

        $manager = $activity->properties['relation_manager']['name'] ?? null;
        if ($manager) {
            $loggerInstance->relationManager($manager);
        }

        return $loggerInstance;
    }
}

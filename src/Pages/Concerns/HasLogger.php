<?php

namespace Noxo\FilamentActivityLog\Pages\Concerns;

use Noxo\FilamentActivityLog\Loggers\Logger;
use Noxo\FilamentActivityLog\Services\Helper;
use Spatie\Activitylog\Models\Activity;

trait HasLogger
{
    public function getLogger(Activity $activity): ?Logger
    {
        $logger = Helper::resolveLogger($activity->subject_type, force: true);
        if (! $logger) {
            return null;
        }

        $loggerInstance = $logger::make();

        $manager = $activity->properties['relation_manager']['name'] ?? null;
        if ($manager) {
            $loggerInstance->relationManager($manager);
        }

        return $loggerInstance;
    }
}

<?php

namespace Noxo\FilamentActivityLog\Loggers\Concerns;

use Noxo\FilamentActivityLog\ResourceLogger\Field;
use Noxo\FilamentActivityLog\ResourceLogger\ResourceLogger;
use Spatie\Activitylog\Models\Activity;

trait HasResourceLogger
{
    public static function resource(ResourceLogger $resourceLogger): ResourceLogger
    {
        return $resourceLogger;
    }

    public static function getResourceLogger(): ResourceLogger
    {
        return static::resource(new ResourceLogger);
    }

    public function getFields(): array
    {
        if ($this->relationManager) {
            return $this->relationManager->getFields();
        }

        return $this->getResourceLogger()->getFields();
    }

    public function getFieldByName(string $name): ?Field
    {
        if ($this->relationManager) {
            return $this->relationManager->getFieldByName($name);
        }

        return $this->getResourceLogger()->getFieldByName($name);
    }

    public function getSubjectRoute(Activity $activity): ?string
    {
        return null;
    }

    public function getSubjectLabel(): ?string
    {
        return $this->getLabel();
    }

    public function getSubjectId(Activity $activity): ?string
    {
        return '#' . $activity->subject_id;
    }
}

<?php

namespace Noxo\FilamentActivityLog\Loggers\Concerns;

use Illuminate\Database\Eloquent\Model;

trait Loggable
{
    /**
     * Log the properties if the condition is met.
     */
    public function logIf(bool $condition, ...$args): void
    {
        if ($condition) {
            $this->log(...$args);
        }
    }

    /**
     * Log the properties Unless the condition is met.
     */
    public function logUnless(bool $condition, ...$args): void
    {
        if (! $condition) {
            $this->log(...$args);
        }
    }

    /**
     * Log the properties.
     */
    public function log(array $properties, string $event, ?Model $modelOn = null): void
    {
        $modelOn ??= $this->newModel;

        if ($this->relationManager && $this->ownerRecord) {
            $modelOn = $this->ownerRecord;
            $properties['relation_manager'] = [
                'name' => $this->relationManager->name,
                'id' => $this->newModel->id,
            ];
        }

        // $this?->beforeLog();

        $activity = activity()
            ->event($event)
            ->on($modelOn)
            ->withProperties($properties);

        if ($this->causedBy) {
            $activity->causedBy($this->causedBy);
        }

        $activity->log($event);

        // $this?->afterLog($activity);
    }
}

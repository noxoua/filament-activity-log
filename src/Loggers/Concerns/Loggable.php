<?php

namespace Noxo\FilamentActivityLog\Loggers\Concerns;

trait Loggable
{
    /**
     * Log the properties if the condition is met.
     */
    public function logIf(bool $condition, array $properties, string $event): void
    {
        if ($condition) {
            $this->log($properties, $event);
        }
    }

    /**
     * Log the properties Unless the condition is met.
     */
    public function logUnless(bool $condition, array $properties, string $event): void
    {
        if (! $condition) {
            $this->log($properties, $event);
        }
    }

    /**
     * Log the properties.
     */
    public function log(array $properties, string $event): void
    {
        // $this?->beforeLog();

        $activity = activity()
            ->event($event)
            ->on($this->newModel)
            ->withProperties($properties)
            ->log($event);

        // $this?->afterLog($activity);
    }
}

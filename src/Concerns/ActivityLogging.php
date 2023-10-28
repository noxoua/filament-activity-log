<?php

namespace Noxo\FilamentActivityLog\Concerns;

trait ActivityLogging
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
            ->on($this->model)
            ->withProperties($properties)
            ->log($event);

        // $this?->afterLog($activity);
    }
}

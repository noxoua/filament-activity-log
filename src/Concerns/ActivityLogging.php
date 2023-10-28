<?php

namespace Noxo\FilamentActivityLog\Concerns;

trait ActivityLogging
{
    /**
     * Log the properties if the condition is met.
     *
     * @param bool $condition
     * @param array $properties
     * @param string $event
     * @return void
     */
    public function logIf(bool $condition, array $properties, string $event): void
    {
        if ($condition) {
            $this->log($properties, $event);
        }
    }

    /**
     * Log the properties Unless the condition is met.
     *
     * @param bool $condition
     * @param array $properties
     * @param string $event
     * @return void
     */
    public function logUnless(bool $condition, array $properties, string $event): void
    {
        if (! $condition) {
            $this->log($properties, $event);
        }
    }

    /**
     * Log the properties.
     *
     * @param array $properties
     * @param string $event
     * @return void
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

<?php

namespace Noxo\FilamentActivityLog\Concerns;

trait Loggable
{
    /**
     * Log the properties if the condition is met.
     *
     * @param  bool  $condition
     * @param  array  $event
     */
    public function logIf($condition, array $properties, string $event = null): void
    {
        if ($condition) {
            $this->log($properties, $event);
        }
    }

    /**
     * Log the properties Unless the condition is met.
     *
     * @param  bool  $condition
     * @param  array  $event
     */
    public function logUnless($condition, array $properties, string $event = null): void
    {
        if (! $condition) {
            $this->log($properties, $event);
        }
    }

    /**
     * Log the properties.
     *
     * @param  array  $event
     */
    public function log(array $properties, string $event = null): void
    {
        // $this?->beforeLog();

        $event = $event ?? debug_backtrace()[1]['function'];
        $activity = activity()
            ->event($event)
            ->on($this->model)
            ->withProperties($properties)
            ->log($event);

        // $this?->afterLog($activity);
    }
}

<?php

namespace Noxo\FilamentActivityLog\Loggers\Concerns;

trait HasEvents
{
    /**
     * Log when a model is created.
     */
    public function created(): void
    {
        $attributes = [];

        foreach ($this->getFields() as $field) {
            $value = $field->getStorableValue($this->newModel);

            if (! empty($value)) {
                $attributes[$field->name] = $value;
            }
        }

        $this->log(
            ['old' => [], 'attributes' => $attributes],
            event: 'created',
        );
    }

    /**
     * Log when a model is updated.
     */
    public function updated(): void
    {
        $old = [];
        $new = [];

        foreach ($this->getFields() as $field) {
            $beforeValue = $field->getStorableValue($this->oldModel);
            $afterValue = $field->getStorableValue($this->newModel);

            if ($field->is('table') && $field->tableDifferenceOnly) {
                [$beforeValue, $afterValue] = $field->resolveTableDifference($beforeValue, $afterValue);
            }

            if ($field->is('key-value') && $field->keyValueDifferenceOnly) {
                [$beforeValue, $afterValue] = $field->resolveKeyValueDifference($beforeValue, $afterValue);
            }

            if ($beforeValue !== $afterValue) {
                $old[$field->name] = $beforeValue;
                $new[$field->name] = $afterValue;
            }
        }

        $this->logIf(
            $old !== $new,
            ['old' => $old, 'attributes' => $new],
            event: 'updated',
        );
    }

    /**
     * Log when a model is deleted.
     */
    public function deleted(): void
    {
        $attributes = [];

        foreach ($this->getFields() as $field) {
            $value = $field->getStorableValue($this->newModel);

            if (! empty($value)) {
                $attributes[$field->name] = $value;
            }
        }

        $this->log(
            ['old' => [], 'attributes' => $attributes],
            event: 'deleted',
        );
    }

    /**
     * Log when a model is restored.
     */
    public function restored(): void
    {
        $this->log(
            ['old' => [], 'attributes' => []],
            event: 'restored',
        );
    }

    /**
     * Log when a model is attached.
     */
    public function attached(): void
    {
        $this->log(
            ['old' => [], 'attributes' => []],
            event: 'attached',
        );
    }

    /**
     * Log when a model is detached.
     */
    public function detached(): void
    {
        $this->log(
            ['old' => [], 'attributes' => []],
            event: 'detached',
        );
    }
}

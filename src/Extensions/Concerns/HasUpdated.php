<?php

namespace Noxo\FilamentActivityLog\Extensions\Concerns;

use Illuminate\Database\Eloquent\Model;

trait HasUpdated
{
    private ?string $logger = null;

    private ?Model $model_old = null;

    public function logRecordBefore($record): void
    {
        if (! $this->logger = $this->resolveLogger($record)) {
            return;
        }

        $this->model_old = clone $record->load(
            $this->logger::getResourceLogger()->getRelationNames()
        );
    }

    public function logRecordAfter($record): void
    {
        if (! $this->logger) {
            return;
        }

        $record->load($this->logger::getResourceLogger()->getRelationNames());
        $this->logger::make($this->model_old, $record)->updated();
    }

    public function logManagerBefore($livewire, $record): void
    {
        $ownerRecord = $livewire->ownerRecord;
        if (! $this->logger = $this->resolveLogger($ownerRecord)) {
            return;
        }

        $manager = $this->logger::getRelationManager($livewire->getRelationshipName());
        $this->model_old = clone $record->load($manager->getRelationNames());
    }

    public function logManagerAfter($livewire, $record): void
    {
        if (! $this->logger) {
            return;
        }

        $manager = $this->logger::getRelationManager($livewire->getRelationshipName());
        $record->load($manager->getRelationNames());

        $this->logger::make($this->model_old, $record)
            ->relationManager($manager)
            ->ownerRecord($livewire->ownerRecord)
            ->updated();
    }
}

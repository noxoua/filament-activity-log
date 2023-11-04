<?php

namespace Noxo\FilamentActivityLog\Extensions\Concerns;

trait HasCreated
{
    public function logRecordCreated($record): void
    {
        if (! $logger = $this->resolveLogger($record)) {
            return;
        }

        $record->load($logger::getResourceLogger()->getRelationNames());
        $logger::make($record)->created();
    }

    public function logManagerCreated($livewire, $record): void
    {
        $ownerRecord = $livewire->ownerRecord;
        if (! $logger = $this->resolveLogger($ownerRecord)) {
            return;
        }

        $manager = $logger::getRelationManager($livewire->getRelationshipName());
        $record->load($manager->getRelationNames());

        $logger::make($record)
            ->relationManager($manager)
            ->ownerRecord($ownerRecord)
            ->created();
    }
}

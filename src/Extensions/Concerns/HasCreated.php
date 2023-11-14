<?php

namespace Noxo\FilamentActivityLog\Extensions\Concerns;

use Noxo\FilamentActivityLog\Services\Helper;

trait HasCreated
{
    public function logRecordCreated($record): void
    {
        if (! $logger = Helper::resolveLogger($record)) {
            return;
        }

        $record->load($logger::getResourceLogger()->getRelationNames());
        $logger::make($record)->created();
    }

    public function logManagerCreated($livewire, $record): void
    {
        $ownerRecord = $livewire->ownerRecord;
        if (! $logger = Helper::resolveLogger($ownerRecord)) {
            return;
        }

        $manager = $logger::getRelationManager(
            get_class($livewire)::getRelationshipName()
        );

        if ($manager) {
            $record->load($manager->getRelationNames());

            $logger::make($record)
                ->relationManager($manager)
                ->ownerRecord($ownerRecord)
                ->created();
        }
    }
}

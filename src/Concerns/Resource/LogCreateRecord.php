<?php

namespace Noxo\FilamentActivityLog\Concerns\Resource;

use Noxo\FilamentActivityLog\Fields\Fields;
use Noxo\FilamentActivityLog\Loggers\Loggers;

trait LogCreateRecord
{
    public function afterCreate()
    {
        $this->logAfterCreate();
    }

    public function logAfterCreate()
    {
        $logger = Loggers::getLoggerByModel(self::getResource()::getModel());

        if ($logger && ! $logger::$disabled) {
            $relations = $logger::fields(new Fields)->getRelationNames();
            $record = $this->record->load($relations);
            $logger::make($record)->created();
        }
    }
}

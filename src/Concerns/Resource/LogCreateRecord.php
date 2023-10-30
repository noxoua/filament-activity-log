<?php

namespace Noxo\FilamentActivityLog\Concerns\Resource;

use Noxo\FilamentActivityLog\ActivityLoggers;

trait LogCreateRecord
{
    public function afterCreate()
    {
        $this->logAfterCreate();
    }

    public function logAfterCreate()
    {
        $logger = ActivityLoggers::getLoggerByModelClass(self::getResource()::getModel());

        if ($logger) {
            $record = $this->record->load($logger::$relations ?? []);
            $logger::make($record)->created();
        }
    }
}

<?php

namespace Noxo\FilamentActivityLog\Concerns\Resource;

use Noxo\FilamentActivityLog\Fields\Fields;
use Noxo\FilamentActivityLog\Loggers\Loggers;

trait LogEditRecord
{
    protected $logger;

    protected $log_model_old;

    public function beforeValidate()
    {
        $this->logBeforeValidate();
    }

    public function afterSave()
    {
        $this->logAfterSave();
    }

    public function logBeforeValidate()
    {
        $this->logger = Loggers::getLoggerByModel(self::getResource()::getModel());

        if ($this->logger && ! $this->logger::$disabled) {
            $this->log_model_old = clone $this->record->load(
                $this->logger::fields(new Fields)->getRelationNames()
            );
        }
    }

    public function logAfterSave()
    {
        if ($this->logger && ! $this->logger::$disabled) {
            $log_model_new = $this->record->load(
                $this->logger::fields(new Fields)->getRelationNames()
            );
            $this->logger::make($this->log_model_old, $log_model_new)->updated();
        }
    }
}

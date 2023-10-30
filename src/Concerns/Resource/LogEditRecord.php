<?php

namespace Noxo\FilamentActivityLog\Concerns\Resource;

use Noxo\FilamentActivityLog\ActivityLoggers;

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
        $this->logger = ActivityLoggers::getLoggerByModelClass(self::getResource()::getModel());

        if ($this->logger) {
            $this->log_model_old = clone $this->record->load(
                $this->logger::$relations ?? []
            );
        }
    }

    public function logAfterSave()
    {
        if ($this->logger) {
            $log_model_new = $this->record->load(
                $this->logger::$relations ?? []
            );
            $this->logger::make($this->log_model_old, $log_model_new)->updated();
        }
    }
}

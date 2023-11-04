<?php

namespace Noxo\FilamentActivityLog\Extensions;

trait LogEditRecord
{
    use Concerns\HasUpdated;

    public function beforeValidate()
    {
        $this->logRecordBefore($this->record);
    }

    public function afterSave()
    {
        $this->logRecordAfter($this->record);
    }
}

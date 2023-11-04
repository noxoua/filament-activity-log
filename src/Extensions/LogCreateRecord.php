<?php

namespace Noxo\FilamentActivityLog\Extensions;

trait LogCreateRecord
{
    use Concerns\HasCreated;

    public function afterCreate()
    {
        $this->logRecordCreated($this->record);
    }
}

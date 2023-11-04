<?php

namespace Noxo\FilamentActivityLog\Extensions;

trait LogCreateRecord
{
    use Concerns\HasCreated;
    use Concerns\LoggerResolver;

    public function afterCreate()
    {
        $this->logRecordCreated($this->record);
    }
}

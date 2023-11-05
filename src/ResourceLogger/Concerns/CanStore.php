<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns;

use Illuminate\Database\Eloquent\Model;

trait CanStore
{
    public function getStorableValue(Model $record): mixed
    {
        if ($this->resolveStateCallback) {
            return call_user_func($this->resolveStateCallback, $record);
        }

        return data_get($record, $this->name);
    }
}

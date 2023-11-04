<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns;

use Illuminate\Database\Eloquent\Model;

trait CanStore
{
    public function getStorableValue(Model $record): mixed
    {
        if ($this->resolveCallback) {
            return call_user_func($this->resolveCallback, $record);
        }

        return $record->{$this->name};
    }
}

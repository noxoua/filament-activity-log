<?php

namespace Noxo\FilamentActivityLog\Fields\Concerns;

use Illuminate\Database\Eloquent\Model;

trait Storable
{
    public function getStorableValue(Model $record): mixed
    {
        if ($this->resolveCallback) {
            return call_user_func($this->resolveCallback, $record);
        }

        return $record->{$this->name};
    }
}

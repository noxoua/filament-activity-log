<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns\Types;

use Illuminate\Database\Eloquent\Model;

trait Relation
{
    public ?string $relationName = null;

    public function hasOne(string $relation): static
    {
        $this->relationName = $relation;

        $this->resolveStateUsing(fn (Model $record): mixed => data_get($record, $this->name));

        return $this;
    }

    public function hasMany(string $relation): static
    {
        $this->relationName = $relation;

        $this->resolveStateUsing(
            fn (Model $record): mixed => data_get($record, $relation)
                ?->pluck(
                    (string) str($this->name)->after("{$relation}.")
                )
                ->toArray()
        );

        return $this;
    }
}

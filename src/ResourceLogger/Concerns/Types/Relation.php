<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns\Types;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait Relation
{
    public bool $isRelation = false;

    public function relation(string $column = null): static
    {
        $this->isRelation = true;

        if ($column) {
            $this->resolveStateUsing(function (Model $record) use ($column): mixed {
                $relation = data_get($record, $this->name);

                if ($relation instanceof Collection) {
                    return $relation->pluck($column)->toArray();
                }

                return data_get($relation, $column);
            });
        }

        return $this;
    }
}

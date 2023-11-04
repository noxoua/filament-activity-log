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
            $this->resolveUsing(function (Model $model) use ($column): mixed {
                $relation = $model->{$this->name};

                if ($relation instanceof Collection) {
                    return $relation->pluck($column)->toArray();
                }

                return $relation->{$column};
            });
        }

        return $this;
    }
}

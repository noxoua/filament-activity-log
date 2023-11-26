<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns\Types;

use Illuminate\Database\Eloquent\Model;
use Noxo\FilamentActivityLog\Services\Helper;
use UnitEnum;

trait Enum
{
    public function enum(string $enum): static
    {
        $this->type('enum', $enum);
        $this->template('badge');

        $this->resolveStateUsing(function (Model $record) {
            $value = data_get($record, $this->name);

            return $value->name ?? $value;
        });

        $this->formatStateUsing(fn ($state): ?UnitEnum => Helper::resolveEnum($this->options, $state));

        return $this;
    }
}

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
        $this->view('badge');

        $this->resolveStateUsing(fn (Model $model) => $model->{$this->name}?->name);

        $this->formatStateUsing(fn ($state): ?UnitEnum => Helper::resolveEnum($this->options, $state));

        return $this;
    }
}

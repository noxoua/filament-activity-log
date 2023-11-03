<?php

namespace Noxo\FilamentActivityLog\Fields\Concerns\Types;

use Illuminate\Database\Eloquent\Model;
use Noxo\FilamentActivityLog\Services\Helper;
use UnitEnum;

trait Enum
{
    public function enum(string $enum): static
    {
        $this->type('enum', $enum);
        $this->view('badge');

        $this->resolveUsing(fn (Model $model) => $model->{$this->name}?->name);

        return $this;
    }

    public function resolveEnum(?string $value): ?UnitEnum
    {
        return Helper::resolveEnum($this->options, $value);
    }
}

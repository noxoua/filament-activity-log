<?php

namespace Noxo\FilamentActivityLog\Fields\Concerns\Types;

use Illuminate\Database\Eloquent\Model;
use Noxo\FilamentActivityLog\Types\BooleanEnum;

trait Boolean
{
    public function boolean(): static
    {
        $this->enum(BooleanEnum::class);
        $this->view('badge');

        $this->resolveUsing(fn (Model $model) => $model->{$this->name} ? 'true' : 'false');

        return $this;
    }
}

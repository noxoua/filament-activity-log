<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns\Types;

use Illuminate\Database\Eloquent\Model;

trait Boolean
{
    public function boolean(): static
    {
        $this->enum(config('filament-activity-log.boolean'));
        $this->view('badge');

        $this->resolveUsing(fn (Model $model) => $model->{$this->name} ? 'true' : 'false');

        return $this;
    }
}

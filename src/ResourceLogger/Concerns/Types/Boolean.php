<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns\Types;

use Illuminate\Database\Eloquent\Model;

trait Boolean
{
    public function boolean(): static
    {
        $this->enum(config('filament-activity-log.boolean'));
        $this->template('badge');

        $this->resolveStateUsing(fn (Model $record) => data_get($record, $this->name) ? 'true' : 'false');

        return $this;
    }
}

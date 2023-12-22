<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns\Types;

use Illuminate\Database\Eloquent\Model;

trait Date
{
    public function date(?string $format = null): static
    {
        $format ??= 'j F, Y';
        $this->datetime($format);

        return $this;
    }

    public function time(?string $format = null): static
    {
        $format ??= 'H:i:s';
        $this->datetime($format);

        return $this;
    }

    public function datetime(?string $format = null): static
    {
        $format ??= 'j F, Y H:i:s';
        $this->type('datetime', $format);

        $this->resolveStateUsing(fn (Model $record) => data_get($record, $this->name)?->toISOString());

        $this->formatStateUsing(function ($state): ?string {
            if (blank($state)) {
                return null;
            }

            try {
                $state = \Carbon\Carbon::parse($state);
                $state = $state?->translatedFormat($this->options);
            } catch (\Exception $e) {
            }

            return $state;
        });

        return $this;
    }
}

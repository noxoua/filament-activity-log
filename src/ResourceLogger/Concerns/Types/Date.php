<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns\Types;

use Illuminate\Database\Eloquent\Model;

trait Date
{
    public function date(string $format = null): static
    {
        $format ??= 'j F, Y';
        $this->datetime($format);

        return $this;
    }

    public function time(string $format = null): static
    {
        $format ??= 'H:i:s';
        $this->datetime($format);

        return $this;
    }

    public function datetime(string $format = null): static
    {
        $format ??= 'j F, Y H:i:s';
        $this->type('datetime', $format);

        $this->resolveUsing(fn (Model $model) => $model->{$this->name}?->toISOString());

        return $this;
    }

    public function formatDatetime(?string $value): ?string
    {
        if (blank($value)) {
            return null;
        }

        try {
            $value = \Carbon\Carbon::parse($value);
            $value = $value?->translatedFormat($this->options);
        } catch (\Exception $e) {
        }

        return $value;
    }
}

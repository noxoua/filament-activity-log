<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns\Types;

use Illuminate\Support\Number;

trait Money
{
    public function money(string $currency = 'EUR'): static
    {
        $this->type('money', $currency);
        $this->template('badge');

        $this->formatStateUsing(fn ($state): ?string => Number::currency(
            (float) $state,
            $this->options,
            app()->getLocale()
        ));

        return $this;
    }
}

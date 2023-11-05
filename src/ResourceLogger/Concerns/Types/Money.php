<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns\Types;

use function Filament\Support\format_money;

trait Money
{
    public function money(string $currency = 'EUR'): static
    {
        $this->type('money', $currency);
        $this->view('badge');

        $this->formatStateUsing(fn ($state): ?string => format_money((float) $state, $this->options));

        return $this;
    }
}

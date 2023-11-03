<?php

namespace Noxo\FilamentActivityLog\Fields\Concerns\Types;

use function Filament\Support\format_money;

trait Money
{
    public function money(string $currency = 'EUR'): static
    {
        $this->type('money', $currency);
        $this->view('badge');

        return $this;
    }

    public function formatMoney(float $value): string
    {
        return format_money($value, $this->options);
    }
}

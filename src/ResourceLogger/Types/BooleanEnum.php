<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Types;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum BooleanEnum: string implements HasColor, HasIcon, HasLabel
{
    case True = 'true';
    case False = 'false';

    public function getLabel(): string
    {
        return __('filament-activity-log::activities.boolean.' . $this->value);
    }

    public function getColor(): ?string
    {
        return match ($this->name) {
            'True' => 'success',
            'False' => 'danger',
        };
    }

    public function getIcon(): ?string
    {
        return match ($this->name) {
            'True' => 'heroicon-o-check-badge',
            'False' => 'heroicon-o-x-circle',
        };
    }
}

<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns\Types;

trait Badge
{
    public string $badgeColor = 'primary';

    public function badge(?string $color = null): static
    {
        $this->template('badge');
        if ($color) {
            $this->badgeColor = $color;
        }

        return $this;
    }
}

<?php

namespace Noxo\FilamentActivityLog\Fields\Concerns\Types;

trait Badge
{
    public string $badgeColor = 'primary';

    public function badge(string $color = null): static
    {
        $this->view('badge');
        if ($color) {
            $this->badgeColor = $color;
        }

        return $this;
    }
}

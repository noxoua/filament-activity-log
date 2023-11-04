<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns;

trait HasView
{
    public ?string $view = 'default';

    public function view(string $view): static
    {
        $this->view = $view;

        return $this;
    }
}

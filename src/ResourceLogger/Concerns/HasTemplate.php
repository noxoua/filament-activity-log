<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns;

trait HasTemplate
{
    public ?string $template = 'default';

    public function template(string $template): static
    {
        $this->template = $template;

        return $this;
    }
}

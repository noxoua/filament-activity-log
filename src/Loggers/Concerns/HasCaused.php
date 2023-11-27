<?php

namespace Noxo\FilamentActivityLog\Loggers\Concerns;

use Illuminate\Database\Eloquent\Model;

trait HasCaused
{
    protected Model | int | string | null $causedBy = null;

    public function causedBy(Model | int | string | null $causedBy): static
    {
        $this->causedBy = $causedBy;

        return $this;
    }
}

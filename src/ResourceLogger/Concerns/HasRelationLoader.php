<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns;

trait HasRelationLoader
{
    /**
     * @var array<string>
     */
    protected array $preloadRelations = [];

    public function preloadRelations($relations): static
    {
        $this->preloadRelations = is_string($relations) ? func_get_args() : $relations;

        return $this;
    }
}

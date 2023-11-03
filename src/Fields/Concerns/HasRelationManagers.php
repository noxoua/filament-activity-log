<?php

namespace Noxo\FilamentActivityLog\Fields\Concerns;

use Closure;
use Noxo\FilamentActivityLog\Fields\RelationManager;

trait HasRelationManagers
{
    /**
     * @var array<RelationManager>
     */
    protected array $relationManagers = [];

    public function relationManagers(array $relationManagers): static
    {
        $this->relationManagers = array_map(
            static fn (Closure $closure, string $name) => $closure(new RelationManager($name)),
            $relationManagers,
            array_keys($relationManagers),
        );

        return $this;
    }

    /**
     * @return array<RelationManager>
     */
    public function getRelationManagers(): array
    {
        return $this->relationManagers;
    }
}

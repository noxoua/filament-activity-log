<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns;

use Closure;
use Noxo\FilamentActivityLog\ResourceLogger\RelationManager;

trait HasRelationManagers
{
    /**
     * @var array<RelationManager>
     */
    protected array $relationManagers = [];

    public function relationManagers(array $relationManagers): static
    {
        $this->relationManagers = array_map(
            function (Closure | RelationManager $closure, ?string $name) {
                if ($closure instanceof RelationManager) {
                    return $closure;
                }

                return $closure(new RelationManager($name));
            },
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

    public function getRelationManager(string $name): ?RelationManager
    {
        foreach ($this->relationManagers as $manager) {
            if ($manager->name === $name) {
                return $manager;
            }
        }

        return null;
    }
}

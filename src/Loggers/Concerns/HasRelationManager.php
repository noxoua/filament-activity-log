<?php

namespace Noxo\FilamentActivityLog\Loggers\Concerns;

use Illuminate\Database\Eloquent\Model;
use Noxo\FilamentActivityLog\ResourceLogger\RelationManager;

trait HasRelationManager
{
    public ?RelationManager $relationManager = null;

    protected ?Model $ownerRecord = null;

    public function relationManager(string | RelationManager $manager): static
    {
        if (is_string($manager)) {
            $manager = static::getRelationManager($manager);
        }

        $this->relationManager = $manager;

        return $this;
    }

    public function ownerRecord(Model $model): static
    {
        $this->ownerRecord = $model;

        return $this;
    }

    public static function getRelationManager(string $name): ?RelationManager
    {
        return static::getResourceLogger()->getRelationManager($name);
    }
}

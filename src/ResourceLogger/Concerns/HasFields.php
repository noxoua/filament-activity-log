<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns;

use Noxo\FilamentActivityLog\ResourceLogger\Field;

trait HasFields
{
    /**
     * @var array<Field>
     */
    protected array $fields = [];

    public function fields(array $fields): static
    {
        $this->fields = array_map(function ($field, $key) {
            if ($field instanceof Field) {
                return $field;
            }

            if (is_int($key)) {
                return new Field($field);
            } elseif (is_string($field)) {
                return new Field($key, $field);
            }

            return $field(new Field($key));
        }, $fields, array_keys($fields));

        return $this;
    }

    /**
     * @return array<Field>
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @return array<string>
     */
    public function getRelationNames(): array
    {
        $relations = [];

        foreach ($this->fields as $field) {
            if ($field instanceof Field && $field->relationName) {
                $relations[] = $field->relationName;
            }
        }

        return array_merge($relations, $this->preloadRelations);
    }

    public function getFieldByName(string $name): ?Field
    {
        foreach ($this->fields as $field) {
            if ($field->name === $name) {
                return $field;
            }
        }

        return null;
    }
}

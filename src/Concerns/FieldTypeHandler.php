<?php

namespace Noxo\FilamentActivityLog\Concerns;

trait FieldTypeHandler
{
    public array $types;

    /**
     * Get the type and values for a given field.
     */
    public function getType(string $key): array
    {
        $typeName = $this->types[$key] ?? null;
        if (empty($typeName)) {
            return [null, null];
        }

        $res = explode(':', $typeName);
        $type = $res[0];
        $values = array_filter(explode(',', $res[1] ?? null));

        return [$type, $values];
    }

    /**
     * Get the type-specific value for a field.
     */
    public function getTypeValue($model, $key): mixed
    {
        [$type, $typeValues] = $this->getType($key);

        switch ($type) {
            case 'date':
                return $model->{$key}?->format('Y-m-d');

            case 'media':
                return $model->{$key}[0]['original_url'] ?? null;

                // case 'multiple_media':
                //     return collect($model->{$key})->pluck('original_url');

            case 'boolean':
                return $model->{$key} ? 'true' : 'false';

                // case 'array':
                //     return collect($model->{$key})->only($typeValues)->toArray();

            case 'pluck':
                return collect($model->{$key})->pluck($typeValues[0])->toArray();

            case 'enum':
                return $model->{$key}?->getLabel();
        }

        return false;
    }
}

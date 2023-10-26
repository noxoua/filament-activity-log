<?php

namespace Noxo\FilamentActivityLog\Concerns;

trait FieldTypeHandler
{
    /**
     * Get the type and values for a given field.
     */
    public function getType(string $key): array
    {
        $typeName = static::$types[$key] ?? null;
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
                return $model->{$key}?->translatedFormat($typeValues[0] ?? 'Y-m-d');

            case 'time':
                return $model->{$key}?->translatedFormat($typeValues[0] ?? 'H:i:s');

            case 'datetime':
                return $model->{$key}?->translatedFormat($typeValues[0] ?? 'Y-m-d H:i:s');

            case 'media':
                $isMultiple = ($typeValues[0] ?? 'single') === 'multiple';
                if ($isMultiple) {
                    return collect($model->{$key})->pluck('original_url')->toArray();
                } else {
                    return $model->{$key}[0]['original_url'] ?? null;
                }

            case 'boolean':
                return $model->{$key} ? 'true' : 'false';

            case 'only':
                return collect($model->{$key})->only((array) $typeValues)->toArray();

            case 'pluck':
                return collect($model->{$key})->pluck($typeValues[0])->toArray();

            case 'enum':
                return $model->{$key}?->getLabel();
        }

        return false;
    }
}

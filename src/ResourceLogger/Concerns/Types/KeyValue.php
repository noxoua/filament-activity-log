<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns\Types;

use Noxo\FilamentActivityLog\ResourceLogger\Types\KeyValueField;

trait KeyValue
{
    public ?KeyValueField $keyValue = null;

    public bool $keyValueDifferenceOnly = true;

    public function keyValue(
        array $fields = [],
        bool $differenceOnly = true,
    ): static {
        $this->type('key-value');
        $this->template('key-value');
        $this->formatStateUsing('array');
        $this->keyValueDifferenceOnly = $differenceOnly;

        if (! empty($fields)) {
            $this->keyValue = KeyValueField::make($fields);

            $this->resolveStateUsing(function ($record) {
                $fields = collect($this->keyValue->getFields());

                return $fields->mapWithKeys(fn ($field) => [
                    $field->name => $field->getStorableValue($record),
                ])->toArray();
            });
        }

        return $this;
    }

    public function resolveKeyValueDifference(mixed $array1, mixed $array2): array
    {
        if (! is_array($array1) || ! is_array($array2)) {
            return [$array1, $array2];
        }

        $diff1 = $this->arrayRecursiveDiff($array1, $array2);
        $diff2 = $this->arrayRecursiveDiff($array2, $array1);

        return [$diff1, $diff2];
    }

    private function arrayRecursiveDiff(array $aArray1, array $aArray2): array
    {
        $aReturn = [];

        foreach ($aArray1 as $mKey => $mValue) {
            if (array_key_exists($mKey, $aArray2)) {
                if (is_array($mValue)) {
                    $aRecursiveDiff = $this->arrayRecursiveDiff($mValue, $aArray2[$mKey]);
                    if (count($aRecursiveDiff)) {
                        $aReturn[$mKey] = $aRecursiveDiff;
                    }
                } else {
                    if ($mValue != $aArray2[$mKey]) {
                        $aReturn[$mKey] = $mValue;
                    }
                }
            } else {
                $aReturn[$mKey] = $mValue;
            }
        }

        return $aReturn;
    }
}

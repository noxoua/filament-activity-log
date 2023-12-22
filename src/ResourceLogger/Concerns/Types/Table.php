<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns\Types;

use Closure;
use Noxo\FilamentActivityLog\ResourceLogger\Types\TableField;

trait Table
{
    public ?TableField $table;

    public bool $tableDifferenceOnly = true;

    public function table(
        array $fields,
        ?Closure $resolveRecords = null,
        bool $differenceOnly = true,
    ): static {
        $this->type('table');
        $this->template('table');
        $this->table = TableField::make($fields);
        $this->tableDifferenceOnly = $differenceOnly;

        $this->formatStateUsing('array');
        $this->resolveStateUsing(function ($record) use ($resolveRecords) {
            $records = collect(
                is_null($resolveRecords)
                ? data_get($record, $this->name)
                : $resolveRecords($record)
            );

            $fields = collect($this->table->getFields());

            return $records->map(function ($record) use ($fields) {
                return $fields->mapWithKeys(fn ($field) => [
                    $field->name => $field->getStorableValue($record),
                ])->toArray();
            })->toArray();
        });

        return $this;
    }

    public function resolveTableDifference(mixed $array1, mixed $array2): array
    {
        if (! is_array($array1) || ! is_array($array2)) {
            return [$array1, $array2];
        }

        foreach ($array1 as $key1 => $row1) {
            foreach ($array2 as $key2 => $row2) {
                if ($row1 === $row2) {
                    unset($array1[$key1], $array2[$key2]);
                }
            }
        }

        $array1 = array_values($array1);
        $array2 = array_values($array2);

        return [$array1, $array2];
    }
}

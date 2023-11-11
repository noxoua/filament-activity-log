<?php

namespace Noxo\FilamentActivityLog\ResourceLogger\Concerns\Types;

use Noxo\FilamentActivityLog\ResourceLogger\Types\TableField;

trait Table
{
    public ?TableField $table;

    public bool $tableDifferenceOnly = true;

    public function table(array $fields = []): static
    {
        $this->type('table');
        $this->view('table');
        $this->table = TableField::make($fields);

        $this->formatStateUsing('array');
        $this->resolveStateUsing(function ($record) {
            $records = collect(data_get($record, $this->name));
            $fields = collect($this->table->getFields());

            return $records->map(function ($record) use ($fields) {
                return $fields->mapWithKeys(fn ($field) => [
                    $field->name => $field->getStorableValue($record),
                ])->toArray();
            })->toArray();
        });

        return $this;
    }
}

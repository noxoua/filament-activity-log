<?php

namespace Noxo\FilamentActivityLog\Macros;

use Noxo\FilamentActivityLog\Fields\Fields;

class CreateAction
{
    public function setLogger()
    {
        return function (string $logger): static {
            if (! $logger::$disabled) {
                $this->after(function ($record) use ($logger) {
                    $record = $record->load(
                        $logger::fields(new Fields)->getRelationNames()
                    );
                    $logger::make($record)->created();
                });
            }

            return $this;
        };
    }
}

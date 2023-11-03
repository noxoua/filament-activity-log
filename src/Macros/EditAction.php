<?php

namespace Noxo\FilamentActivityLog\Macros;

use Noxo\FilamentActivityLog\Fields\Fields;

class EditAction
{
    public function setLogger()
    {
        return function (string $logger): static {
            $model_old = null;

            if (! $logger::$disabled) {
                $this->beforeFormValidated(function ($record) use (&$model_old, $logger) {
                    $model_old = clone $record->load(
                        $logger::fields(new Fields)->getRelationNames()
                    );
                });

                $this->after(function ($record) use (&$model_old, $logger) {
                    $model_new = $record->load(
                        $logger::fields(new Fields)->getRelationNames()
                    );
                    $logger::make($model_old, $model_new)->updated();
                });
            }

            return $this;
        };
    }
}

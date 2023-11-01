<?php

namespace Noxo\FilamentActivityLog\Macros;

class EditAction
{
    public function setLogger()
    {
        return function (string $logger): static {
            $model_old = null;

            $this->beforeFormValidated(function ($record) use (&$model_old, $logger) {
                $model_old = clone $record->load($logger::$relations ?? []);
            });

            $this->after(function ($record) use (&$model_old, $logger) {
                $model_new = $record->load($logger::$relations ?? []);
                $logger::make($model_old, $model_new)->updated();
            });

            return $this;
        };
    }
}

<?php

namespace Noxo\FilamentActivityLog\Macros;

class CreateAction
{
    public function setLogger()
    {
        return function (string $logger): static {
            $this->after(function ($record) use ($logger) {
                $record = $record->load($logger::$relations ?? []);
                $logger::make($record)->created();
            });

            return $this;
        };
    }
}

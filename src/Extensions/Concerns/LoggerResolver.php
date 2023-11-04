<?php

namespace Noxo\FilamentActivityLog\Extensions\Concerns;

use Illuminate\Database\Eloquent\Model;
use Noxo\FilamentActivityLog\Loggers\Logger;
use Noxo\FilamentActivityLog\Loggers\Loggers;

trait LoggerResolver
{
    /**
     * @return class-string<Logger>
     */
    protected function resolveLogger(string | Model $record): ?string
    {
        $name = is_string($record) ? $record : get_class($record);

        return Loggers::getLoggerByModel($name);
    }
}

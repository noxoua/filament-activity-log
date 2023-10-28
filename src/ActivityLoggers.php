<?php

namespace Noxo\FilamentActivityLog;

use Illuminate\Filesystem\Filesystem;
use ReflectionClass;

class ActivityLoggers
{
    public static array $loggers = [];

    public static function discover(): void
    {
        $config = config('filament-activity-log.loggers');
        $directory = $config['directory'];
        $namespace = $config['namespace'];
        $baseClass = ActivityLogger::class;

        if (blank($directory) || blank($namespace)) {
            return;
        }

        $filesystem = app(Filesystem::class);

        if ((! $filesystem->exists($directory)) && (! str($directory)->contains('*'))) {
            return;
        }

        $namespace = str($namespace);

        foreach ($filesystem->allFiles($directory) as $file) {
            $variableNamespace = $namespace->contains('*') ? str_ireplace(
                ['\\' . $namespace->before('*'), $namespace->after('*')],
                ['', ''],
                str($file->getPath())
                    ->after(base_path())
                    ->replace(['/'], ['\\']),
            ) : null;

            if (is_string($variableNamespace)) {
                $variableNamespace = (string) str($variableNamespace)->before('\\');
            }

            $class = (string) $namespace
                ->append('\\', $file->getRelativePathname())
                ->replace('*', $variableNamespace ?? '')
                ->replace(['/', '.php'], ['\\', '']);

            if (! class_exists($class)) {
                continue;
            }

            if ((new ReflectionClass($class))->isAbstract()) {
                continue;
            }

            if (! is_subclass_of($class, $baseClass)) {
                continue;
            }

            self::$loggers[] = $class;
        }
    }

    public static function registerEvents(): void
    {
        foreach (self::$loggers as $logger) {
            foreach ($logger::$events as $event) {
                $logger::$modelClass::{$event}(function ($model) use ($logger, $event) {
                    if ($event === 'updated') {
                        $old = $model::make($model->getOriginal());
                        $new = $model::make($model->getAttributes());
                        $old->id = $model->id;
                        $logger::make($old, $new)->updated();
                    } else {
                        $logger::make($model)->{$event}();
                    }
                });
            }
        }
    }
}

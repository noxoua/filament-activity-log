<?php

namespace Noxo\FilamentActivityLog\Loggers;

use Illuminate\Filesystem\Filesystem;
use ReflectionClass;

class Loggers
{
    public static array $loggers = [];

    /**
     * @return class-string<Logger>
     */
    public static function getLoggerByModel(string $model, bool $force = false): ?string
    {
        foreach (self::$loggers as $logger) {
            if ($logger::$model === $model && (! $logger::$disabled || $force)) {
                return $logger;
            }
        }

        return null;
    }

    public static function discover(): void
    {
        $config = config('filament-activity-log.loggers');

        if (array_key_exists('panels', $config) && count($config['panels']) > 0) {
            foreach ($config['panels'] as $panelLoggers) {
                static::setLogger($panelLoggers['directory'], $panelLoggers['namespace']);
            }
        }

        // Default panel
        $directory = $config['directory'];
        $namespace = $config['namespace'];

        static::setLogger($directory, $namespace);
    }

    private static function setLogger(string $directory, string $namespace): void
    {
        if (blank($directory) || blank($namespace)) {
            return;
        }

        $baseClass = Logger::class;

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

            if ($class::$disabled) {
                continue;
            }

            self::$loggers[] = $class;
        }
    }
}

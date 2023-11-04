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
        $directory = $config['directory'];
        $namespace = $config['namespace'];
        $baseClass = Logger::class;

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

            if ($class::$disabled) {
                continue;
            }

            self::$loggers[] = $class;
        }
    }
}

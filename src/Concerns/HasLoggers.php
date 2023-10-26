<?php

namespace Noxo\FilamentActivityLog\Concerns;

use Illuminate\Filesystem\Filesystem;
use Noxo\FilamentActivityLog\ActivityLogger;
use ReflectionClass;
use Spatie\Activitylog\Models\Activity;

trait HasLoggers
{
    public array $loggers = [];

    public function getFieldView(Activity $activity, string $field): ?string
    {
        $loggerClass = $this->loggers[$activity->subject_type];
        return $loggerClass ? $loggerClass::$fieldViews[$field] ?? null : null;
    }

    public function getFieldType(Activity $activity, string $field): ?string
    {
        $loggerClass = $this->loggers[$activity->subject_type];
        return $loggerClass ? $loggerClass::$types[$field] ?? null : null;
    }

    public function getLoggerConfigurations(): array
    {
        return [
            'in' => app_path('Filament/Loggers'),
            'for' => 'App\\Filament\\Loggers',
        ];
    }

    protected function discoverLoggers(): void
    {
        $loggerConfig = $this->getLoggerConfigurations();
        $directory = $loggerConfig['in'];
        $namespace = $loggerConfig['for'];
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

            $this->loggers[$class::$modelClass] = $class;
        }
    }
}

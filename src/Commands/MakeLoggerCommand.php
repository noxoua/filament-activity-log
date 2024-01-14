<?php

namespace Noxo\FilamentActivityLog\Commands;

use Filament\Facades\Filament;
use Filament\Panel;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;

use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class MakeLoggerCommand extends Command
{
    protected $description = 'Create a new Filament logger class';

    protected $signature = 'make:filament-logger {name?} {--panel=}';

    public function handle(): int
    {
        $model = (string) str($this->argument('name') ?? text(
            label: 'What is the model name?',
            placeholder: 'User',
            required: true,
        ))
            ->studly()
            ->trim('/')
            ->trim('\\')
            ->trim(' ')
            ->studly()
            ->replace('/', '\\');

        if (blank($model)) {
            $this->components->error('Model is required.');

            return static::FAILURE;
        }

        $modelClass = (string) str($model)->afterLast('\\');
        $modelNamespace = str($model)->contains('\\') ?
            (string) str($model)->beforeLast('\\') :
            '';

        $panel = $this->option('panel');

        if ($panel) {
            $panel = Filament::getPanel($panel);
        }

        if (! $panel) {
            $panels = Filament::getPanels();

            /** @var Panel $panel */
            $panel = (count($panels) > 1) ? $panels[select(
                label: 'Which panel would you like to create this in?',
                options: array_map(
                    fn (Panel $panel): string => $panel->getId(),
                    $panels,
                ),
                default: Filament::getDefaultPanel()->getId()
            )] : Arr::first($panels);
        }

        $resourceDirectories = $panel->getResourceDirectories();
        $resourceNamespaces = $panel->getResourceNamespaces();
        $resourceNamespace = Arr::first($resourceNamespaces, default: 'App\\Filament\\Resources');

        $namespace = (count($resourceNamespaces) > 1) ?
            select(
                label: 'Which namespace would you like to create this in?',
                options: $resourceNamespaces
            ) : $resourceNamespace;

        $path = (count($resourceDirectories) > 1) ?
            $resourceDirectories[array_search($namespace, $resourceNamespaces)] :
            Arr::first($resourceDirectories, default: app_path('Filament/Resources/'));

        $path = str_replace('/Resources', '/Loggers', $path);
        $namespace = str_replace('\\Resources', '\\Loggers', $namespace);

        $loggerClass = "{$modelClass}Logger";
        $namespace .= $modelNamespace !== '' ? "\\{$modelNamespace}" : '';

        $baseLoggerPath =
            (string) str($loggerClass)
                ->prepend('/')
                ->prepend($path)
                ->replace('\\', '/')
                ->replace('//', '/');

        $loggerPath = "{$baseLoggerPath}.php";

        $this->copyStubToApp($loggerPath, [
            'namespace' => $namespace,
            'class' => $loggerClass,
            'modelClass' => $modelClass,
            'resourceNamespace' => $resourceNamespace,
            'modelNamespace' => 'App\\Models' . ($modelNamespace !== '' ? "\\{$modelNamespace}" : '') . '\\' . $modelClass,
        ]);

        $this->components->info("Filament logger [{$loggerPath}] created successfully.");

        return static::SUCCESS;
    }

    /**
     * @param  array<string, string>  $replacements
     */
    protected function copyStubToApp(string $targetPath, array $replacements = []): void
    {
        $filesystem = app(Filesystem::class);

        $stubPath = __DIR__ . '/../../stubs/Logger.stub';

        $stub = str($filesystem->get($stubPath));

        foreach ($replacements as $key => $replacement) {
            $stub = $stub->replace("{{ {$key} }}", $replacement);
        }

        $filesystem->ensureDirectoryExists(
            pathinfo($targetPath, PATHINFO_DIRNAME),
        );

        $filesystem->put($targetPath, (string) $stub);
    }
}

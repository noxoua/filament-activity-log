<?php

namespace Noxo\FilamentActivityLog;

use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentActivityLogServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-activity-log';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasCommands([
                Commands\MakeLoggerCommand::class,
            ])
            ->hasConfigFile()
            ->hasTranslations()
            ->hasViews();
    }

    public function shortName(): string
    {
        return self::$name;
    }

    public function bootingPackage()
    {
        ActivityLoggers::discover();
        ActivityLoggers::registerEvents();

        \Filament\Tables\Actions\EditAction::mixin(new Macros\EditAction);
        \Filament\Actions\CreateAction::mixin(new Macros\CreateAction);

        FilamentAsset::register([
            Css::make('filament-activity-log', __DIR__ . '/../resources/dist/filament-activity-log.css'),
        ], $this->shortName());
    }
}

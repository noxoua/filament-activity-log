<?php

namespace Noxo\FilamentActivityLog\Pages;

use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Pages\Page;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Tables\Concerns\CanPaginateRecords;
use Illuminate\Support\Collection;
use Livewire\Features\SupportPagination\HandlesPagination;
use Spatie\Activitylog\Models\Activity;

abstract class ListActivities extends Page implements HasForms
{
    use CanPaginateRecords;
    use HandlesPagination;
    use InteractsWithFormActions;
    use InteractsWithRecord;

    protected static string $view = 'filament-activity-log::list-activities';

    protected static Collection $fieldLabelMap;

    public function getBreadcrumb(): string
    {
        return __('filament-activity-log::activities.breadcrumb');
    }

    public function getTitle(): string
    {
        return __('filament-activity-log::activities.title');
    }

    public function getActivities()
    {
        return $this->paginateTableQuery(
            Activity::latest()
        );
    }

    public function getSubjectLabel(Activity $activity): string
    {
        $name = last(explode('\\', $activity->subject_type));
        return __('filament-activity-log::activities.subjects.' . strtolower($name));
    }

    public function getFieldLabel(string $name): string
    {
        $name = static::$fieldLabelMap[$name] ?? $name;
        return __("filament-activity-log::activities.labels.{$name}");
    }

    protected function getIdentifiedTableQueryStringPropertyNameFor(string $property): string
    {
        return $property;
    }

    protected function getDefaultTableRecordsPerPageSelectOption(): int
    {
        return 10;
    }

    protected function getTableRecordsPerPageSelectOptions(): array
    {
        return [10, 25, 50];
    }
}

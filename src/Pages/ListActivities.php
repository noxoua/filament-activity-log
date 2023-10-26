<?php

namespace Noxo\FilamentActivityLog\Pages;

use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Tables\Concerns\CanPaginateRecords;
use Livewire\WithPagination;
use Spatie\Activitylog\Models\Activity;

abstract class ListActivities extends Page implements HasForms
{
    use CanPaginateRecords,
        InteractsWithForms,
        WithPagination,
        Concerns\HasLoggers,
        Concerns\LogFormatting,
        Concerns\UrlHandling;

    protected static string $view = 'filament-activity-log::list-activities';

    public ?array $data = [];

    public function mount(): void
    {
        $this->discoverLoggers();

        $this->form->fill(request()->only([
            'causer',
            'subject_type',
            'subject_id',
            'event',
        ]));
    }

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->compact()
                    ->columns(4)
                    ->schema([
                        Forms\Components\Select::make('causer')
                            ->label(__('filament-activity-log::activities.filters.causer'))
                            ->options(function () {
                                $causers = Activity::query()
                                    ->groupBy('causer_id', 'causer_type')
                                    ->get(['causer_id', 'causer_type'])
                                    ->map(fn ($activity) => [
                                        'value' => "{$activity->causer_type}:{$activity->causer_id}",
                                        'label' => $activity->causer?->name,
                                        // 'avatar' => $activity->causer?->getFilamentAvatarUrl(),
                                    ])
                                    ->pluck('label', 'value');

                                return $causers;
                            }),

                        Forms\Components\Select::make('subject_type')
                            ->label(__('filament-activity-log::activities.filters.subject_type'))
                            ->options(function () {
                                $subjects = Activity::query()
                                    ->groupBy('subject_type')
                                    ->pluck('subject_type')
                                    ->map(fn ($subject) => [
                                        'value' => $subject,
                                        'label' => __('filament-activity-log::activities.subjects.' . str($subject)->afterLast('\\')->lower()),
                                    ])
                                    ->pluck('label', 'value');

                                return $subjects;
                            }),

                        Forms\Components\TextInput::make('subject_id')
                            ->label(__('filament-activity-log::activities.filters.subject_id'))
                            ->visible(fn (callable $get) => $get('subject_type'))
                            ->numeric(),

                        Forms\Components\Select::make('event')
                            ->label(__('filament-activity-log::activities.filters.event'))
                            ->visible(fn (callable $get) => $get('subject_type'))
                            ->options(function (callable $get) {
                                $events = Activity::query()
                                    ->where('subject_type', $get('subject_type'))
                                    ->groupBy('event')
                                    ->pluck('event')
                                    ->map(fn ($event) => [
                                        'value' => $event,
                                        'label' => __("filament-activity-log::activities.events.{$event}.title"),
                                    ])
                                    ->pluck('label', 'value');

                                return $events;
                            }),
                    ]),
            ])
            ->debounce()
            ->statePath('data');
    }

    public function getTitle(): string
    {
        return __('filament-activity-log::activities.title');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament-activity-log::activities.title');
    }

    public function getActivities()
    {
        $state = $this->form->getState();
        $causer = with($state['causer'], function ($causer) {
            if (empty($causer)) {
                return null;
            }

            [$causer_type, $causer_id] = explode(':', $causer);

            return compact('causer_type', 'causer_id');
        });

        return $this->paginateTableQuery(
            Activity::latest()
                ->unless(
                    empty($causer),
                    fn ($query) => $query->where($causer)
                )
                ->unless(
                    empty($state['subject_type']),
                    fn ($query) => $query->where('subject_type', $state['subject_type'])
                )
                ->unless(
                    empty($state['subject_id']),
                    fn ($query) => $query->where('subject_id', $state['subject_id'])
                )
                ->unless(
                    empty($state['event']),
                    fn ($query) => $query->where('event', $state['event'])
                )
        );
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

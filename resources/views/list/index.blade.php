<x-filament-panels::page>
    @php
        $activities = $this->getActivities();
    @endphp

    <div class="relative">
        {{ $this->form }}

        @if ($this->hasActiveFilters())
            <div class="absolute top-1 right-4">
                <x-filament::link :attributes="\Filament\Support\prepare_inherited_attributes(
                    new \Illuminate\View\ComponentAttributeBag([
                        'color' => 'danger',
                        'tag' => 'button',
                        'wire:click' => 'resetFiltersForm',
                        'wire:loading.remove.delay.' . config('filament.livewire_loading_delay', 'default') => '',
                    ]),
                )">
                    {{ __('filament-tables::table.filters.actions.reset.label') }}
                </x-filament::link>
            </div>
        @endif
    </div>

    @if ($activities->isNotEmpty() && $this->isCollapsible)
        <div class="flex justify-end gap-x-3">
            <x-filament::link
                color="gray"
                tag="button"
                size="sm"
                x-on:click="$dispatch('collapse-all')"
            >
                @lang('filament-forms::components.repeater.actions.collapse_all.label')
            </x-filament::link>

            <x-filament::link
                color="gray"
                tag="button"
                size="sm"
                x-on:click="$dispatch('expand-all')"
            >
                @lang('filament-forms::components.repeater.actions.expand_all.label')
            </x-filament::link>
        </div>
    @endif

    <div class="space-y-4">
        @php
            $prevDate = null;
        @endphp

        @forelse ($activities as $activity)
            @php
                $date = $activity->created_at->translatedFormat(__('filament-activity-log::activities.date_format'));

                /* @var \Noxo\FilamentActivityLog\Loggers\Logger $logger */
                $logger = $this->getLogger($activity);
                if (!$logger) {
                    continue;
                }
            @endphp

            @if ($date != $prevDate)
                <div @class([
                    'px-4 py-2 w-fit mx-auto',
                    'shadow-md rounded-full',
                    'bg-white text-gray-600 text-sm font-medium',
                    'dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300',
                    'sticky top-20',
                ])>
                    {{ $date }}
                </div>
                @php
                    $prevDate = $date;
                @endphp
            @endif

            {{ view('filament-activity-log::list.item', compact('activity', 'logger')) }}
        @empty

            <div @class([
                'p-4 text-center bg-white rounded-xl shadow',
                'dark:border-gray-600 dark:bg-gray-800 text-gray-500',
            ])>
                @lang('filament-activity-log::activities.table.no_records_yet')
            </div>
        @endforelse

        @if ($activities->isNotEmpty())
            <x-filament::pagination
                :page-options="$this->getTableRecordsPerPageSelectOptions()"
                :paginator="$this->getActivities()"
                class="px-3 py-3 sm:px-6"
            />
        @endif
    </div>
</x-filament-panels::page>

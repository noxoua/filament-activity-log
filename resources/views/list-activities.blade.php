<x-filament-panels::page>
    {{ $this->form }}

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

    <div class="space-y-4">
        @php
            $activities = $this->getActivities();
            $prevDate = null;
        @endphp

        @foreach ($this->getActivities() as $activityItem)
            @php
                $date = $activityItem->created_at->translatedFormat(__('filament-activity-log::activities.date_format'));
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

            <div
                @class([
                    'p-2 space-y-2 bg-white rounded-xl shadow',
                    'dark:border-gray-600 dark:bg-gray-800',
                ])
                x-data="{
                    isCollapsed: true,
                }"
                @collapse-all.window="() => isCollapsed = false"
                @expand-all.window="() => isCollapsed = true"
            >
                @php
                    /* @var \Spatie\Activitylog\Models\Activity $activityItem */
                    $changes = $activityItem->getChangesAttribute();
                    $hasChanges = !empty($changes['attributes']);
                @endphp

                <x-filament-activity-log::components.header
                    :$activityItem
                    :$hasChanges
                />

                @if ($hasChanges)
                    <div x-show="isCollapsed">
                        <x-filament-activity-log::components.table
                            :$activityItem
                            :$changes
                        />
                    </div>
                @endif
            </div>
        @endforeach

        <x-filament::pagination
            :page-options="$this->getTableRecordsPerPageSelectOptions()"
            :paginator="$this->getActivities()"
            class="px-3 py-3 sm:px-6"
        />
    </div>
</x-filament-panels::page>

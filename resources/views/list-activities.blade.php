<x-filament-panels::page>
    <div class="space-y-6">
        @foreach ($this->getActivities() as $activityItem)
            <div @class([
                'p-2 space-y-2 bg-white rounded-xl shadow',
                'dark:border-gray-600 dark:bg-gray-800',
            ])>
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
                    {{-- <x-filament-activity-log::components.table
                        :$activityItem
                        :$changes
                    /> --}}
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

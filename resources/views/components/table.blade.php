@props(['activityItem', 'changes'])

<x-filament-tables::table class="w-full overflow-hidden text-sm">
    <x-slot:header>
        <x-filament-tables::header-cell class="!py-2">
            @lang('filament-activity-log::activities.table.field')
        </x-filament-tables::header-cell>
        <x-filament-tables::header-cell class="!py-2">
            @lang('filament-activity-log::activities.table.old')
        </x-filament-tables::header-cell>
        <x-filament-tables::header-cell class="!py-2">
            @lang('filament-activity-log::activities.table.new')
        </x-filament-tables::header-cell>
    </x-slot:header>

    @foreach ($changes['attributes'] as $field => $newValue)
        @php($oldValue = $changes['old'][$field] ?? null)

        <x-filament-tables::row @class(['bg-gray-100/30 dark:bg-gray-900' => $loop->even])>
            <x-filament-tables::cell
                width="20%"
                class="px-4 py-2 align-top sm:first-of-type:ps-6 sm:last-of-type:pe-6"
            >
                {{ $this->getFieldLabel($activityItem, $field) }}
            </x-filament-tables::cell>
            <x-filament-tables::cell
                width="40%"
                class="px-4 py-2 align-top break-all !whitespace-normal"
            >
                <x-filament-activity-log::components.table-value
                    :$activityItem
                    :field="$field"
                    :value="$oldValue"
                />
            </x-filament-tables::cell>
            <x-filament-tables::cell
                width="40%"
                class="px-4 py-2 align-top break-all !whitespace-normal"
            >
                <x-filament-activity-log::components.table-value
                    :$activityItem
                    :field="$field"
                    :value="$newValue"
                />
            </x-filament-tables::cell>
        </x-filament-tables::row>
    @endforeach
</x-filament-tables::table>

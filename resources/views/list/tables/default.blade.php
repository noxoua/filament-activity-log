<x-filament-tables::table class="w-full overflow-hidden text-sm !table-fixed">
    <x-slot:header>
        <x-filament-tables::header-cell
            width="20%"
            class="!py-2"
        >
            @lang('filament-activity-log::activities.table.field')
        </x-filament-tables::header-cell>
        <x-filament-tables::header-cell
            width="40%"
            class="!py-2"
        >
            @lang('filament-activity-log::activities.table.old')
        </x-filament-tables::header-cell>
        <x-filament-tables::header-cell
            width="40%"
            class="!py-2"
        >
            @lang('filament-activity-log::activities.table.new')
        </x-filament-tables::header-cell>
    </x-slot:header>

    @foreach ($changes['attributes'] as $key => $newValue)
        @php
            $field = $logger->getFieldByName($key);
            if (!$field) {
                continue;
            }

            $oldValue = $changes['old'][$key] ?? null;
        @endphp

        <x-filament-tables::row @class(['bg-gray-100/30 dark:bg-gray-900' => $loop->even])>
            <x-filament-tables::cell class="px-4 py-2 align-top sm:first-of-type:ps-6 sm:last-of-type:pe-6">
                {{ $field->getLabel() }}
            </x-filament-tables::cell>

            @if ($field->is('difference'))
                <x-filament-tables::cell
                    colspan="2"
                    class="px-4 py-2 align-top break-all !whitespace-normal"
                >
                    {{ view('filament-activity-log::components.difference', [
                        'options' => $field->options,
                        'oldValue' => $field->display($oldValue, raw: true),
                        'newValue' => $field->display($newValue, raw: true),
                    ]) }}
                </x-filament-tables::cell>
            @else
                <x-filament-tables::cell class="px-4 py-2 align-top overflow-x-scroll">
                    {{ $field->display($oldValue) }}
                </x-filament-tables::cell>

                <x-filament-tables::cell class="px-4 py-2 align-top overflow-x-scroll">
                    {{ $field->display($newValue) }}
                </x-filament-tables::cell>
            @endif

        </x-filament-tables::row>
    @endforeach
</x-filament-tables::table>

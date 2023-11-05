@if (!empty($value))
    <x-filament-tables::table class="w-full overflow-hidden text-sm">
        <x-slot:header>
            @foreach (array_keys($value[0]) as $key)
                <x-filament-tables::header-cell class="!py-2">
                    {{ $key }}
                </x-filament-tables::header-cell>
            @endforeach
        </x-slot:header>


        @foreach ($value as $item)
            <x-filament-tables::row @class(['bg-gray-100/30 dark:bg-gray-900' => $loop->even])>
                @foreach ($item as $_value)
                    <x-filament-tables::cell class="px-4 py-2 align-top sm:first-of-type:ps-6 sm:last-of-type:pe-6">
                        {{ $_value }}
                    </x-filament-tables::cell>
                @endforeach
            </x-filament-tables::row>
        @endforeach
    </x-filament-tables::table>
@endif

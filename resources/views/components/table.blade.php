@if (!empty($value))
    @php
        $fields = $field->table->getFields();
        $isHtmlAllowed = $field->isHtmlAllowed();
    @endphp

    <div class="w-full overflow-x-auto border border-gray-200 dark:border-white/5 rounded-lg">
        <x-filament-tables::table>
            <x-slot:header>
                @foreach ($fields as $field)
                    <x-filament-tables::header-cell class="!p-2">
                        {{ $field->getLabel() }}
                    </x-filament-tables::header-cell>
                @endforeach
            </x-slot:header>


            @foreach ($value as $item)
                <x-filament-tables::row>
                    @foreach ($fields as $field)
                        <x-filament-tables::cell class="p-2 align-top">
                            @php
                                $rawValue = $item[$field->name] ?? data_get($item, $field->name);
                                $dispayValue = $field->display($rawValue);
                            @endphp

                            @if ($isHtmlAllowed)
                                {!! $dispayValue !!}
                            @else
                                {{ $dispayValue }}
                            @endif
                        </x-filament-tables::cell>
                    @endforeach
                </x-filament-tables::row>
            @endforeach
        </x-filament-tables::table>
    </div>
@endif

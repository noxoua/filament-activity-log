@if (!empty($value))
    @php
        $hasFields = $field->keyValue instanceof \Noxo\FilamentActivityLog\ResourceLogger\Types\KeyValueField;
        if ($hasFields) {
            $fields = $field->keyValue->getFields();
        }
        $isHtmlAllowed = $field->isHtmlAllowed();
    @endphp


    <div class="rounded-lg shadow-sm bg-gray-50 dark:bg-transparent ring-1 ring-gray-950/10 dark:ring-white/20">
        <table class="w-full table-auto truncate">
            @if ($hasFields)
                <tbody class="divide-y divide-gray-200 dark:divide-white/20">
                    @foreach ($fields as $key => $keyValueField)
                        @php
                            if (!array_key_exists($keyValueField->name, $value)) {
                                continue;
                            }
                            $rawValue = $value[$keyValueField->name];
                            $dispayValue = $keyValueField->display($rawValue);
                        @endphp

                        <tr class="divide-x divide-gray-200 dark:divide-white/20 rtl:divide-x-reverse">
                            <td class="font-mono text-xs p-2 w-[1%] whitespace-nowrap">
                                {{ $keyValueField->getLabel() }}
                            </td>

                            <td class="font-mono text-xs p-2 truncate max-w-0">
                                @if ($isHtmlAllowed)
                                    {!! $dispayValue !!}
                                @else
                                    {{ $dispayValue }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            @else
                <tbody class="divide-y divide-gray-200 dark:divide-white/20">
                    @foreach ((array) $value as $key => $_value)
                        <tr class="divide-x divide-gray-200 dark:divide-white/20 rtl:divide-x-reverse">
                            <td class="font-mono text-xs p-2 w-[1%] whitespace-nowrap">
                                {{ $key }}
                            </td>

                            <td class="font-mono text-xs p-2 truncate max-w-0">
                                @if ($isHtmlAllowed)
                                    {!! $_value !!}
                                @else
                                    {{ $_value }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            @endif
        </table>
    </div>
@endif

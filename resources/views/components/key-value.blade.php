<div class="rounded-lg shadow-sm bg-gray-50 dark:bg-transparent ring-1 ring-gray-950/10 dark:ring-white/20">
    <table class="w-full table-auto">
        <tbody class="divide-y divide-gray-200 dark:divide-white/20">
            @foreach ((array) $value as $key => $_value)
                <tr class="divide-x divide-gray-200 dark:divide-white/20 rtl:divide-x-reverse">
                    <td class="font-mono text-xs p-2">
                        {{ $key }}
                    </td>

                    <td class="font-mono text-xs p-2">
                        {{ $_value }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

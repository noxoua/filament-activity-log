<div
    @class([
        'p-2 space-y-2 bg-white rounded-xl shadow group',
        'dark:border-gray-600 dark:bg-gray-800',
    ])
    x-data="{
        isCollapsed: @json($this->isCollapsible ? $this->isCollapsed : false),
    }"
    @collapse-all.window="() => isCollapsed = true"
    @expand-all.window="() => isCollapsed = false"
>
    @php
        /* @var \Spatie\Activitylog\Models\Activity $activity */
        $changes = $activity->getChangesAttribute();
        $hasChanges = !empty($changes['attributes']);
    @endphp

    @php
        $isInlineSingle = null;
        $inlineField = null;
        $withoutOldValue = empty($changes['old']);

        // TODO: move to a function
        if ($hasChanges && !$withoutOldValue) {
            $isInlineSingle = count($changes['attributes']) === 1;
            if ($isInlineSingle) {
                foreach ($changes['attributes'] as $key => $newValue) {
                    $field = $logger->getFieldByName($key);
                    if (!$field) {
                        continue;
                    }

                    $oldValue = $changes['old'][$key] ?? null;

                    if ($field->isInline()) {
                        $inlineField = [$field, $oldValue, $newValue];
                        break;
                    }
                }
            }
        }
    @endphp

    {{ view('filament-activity-log::list.header', compact('activity', 'hasChanges', 'logger', 'inlineField')) }}

    @if (!$isInlineSingle && $hasChanges)
        @php
            $table = $withoutOldValue ? 'simple' : 'default';
        @endphp

        <div x-show="!isCollapsed">
            {{ view('filament-activity-log::list.tables.' . $table, compact('changes', 'logger')) }}
        </div>
    @endif
</div>

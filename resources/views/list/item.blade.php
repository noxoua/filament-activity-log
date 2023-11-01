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
        /* @var \Spatie\Activitylog\Models\Activity $activity */
        $changes = $activity->getChangesAttribute();
        $hasChanges = !empty($changes['attributes']);
    @endphp

    {{ view('filament-activity-log::list.header', compact('activity', 'hasChanges')) }}

    @if ($hasChanges)
        <div x-show="isCollapsed">
            {{ view('filament-activity-log::list.table', compact('activity', 'changes')) }}
        </div>
    @endif
</div>

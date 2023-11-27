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

    {{ view('filament-activity-log::list.header', compact('activity', 'hasChanges', 'logger')) }}

    @if ($hasChanges)
        @php
            $table = empty($changes['old']) ? 'simple' : 'default';
        @endphp

        <div x-show="!isCollapsed">
            {{ view('filament-activity-log::list.tables.' . $table, compact('changes', 'logger')) }}
        </div>
    @endif
</div>

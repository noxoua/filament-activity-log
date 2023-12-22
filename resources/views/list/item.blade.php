@use(Noxo\FilamentActivityLog\Services\Helper)

<div
    @class([
        'p-2 space-y-2 bg-white rounded-xl shadow group',
        'dark:border-gray-600 dark:bg-gray-900',
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
        $attributes = (array) ($changes['attributes'] ?? []);
        $old = (array) ($changes['old'] ?? []);
        $hasChanges = !empty($attributes);
        $hasOld = !empty($old);
    @endphp

    @php
        $isInlineSingle = count($attributes) === 1;
        $inlineField = $hasOld && $isInlineSingle ? Helper::resolveInlineField($logger, $attributes, $old) : null;
    @endphp

    {{ view('filament-activity-log::list.header', compact('activity', 'hasChanges', 'logger', 'inlineField')) }}

    @if (empty($inlineField) && $hasChanges)
        @php
            $table = !$hasOld ? 'simple' : 'default';
        @endphp

        <div x-show="!isCollapsed">
            {{ view('filament-activity-log::list.tables.' . $table, compact('changes', 'logger')) }}
        </div>
    @endif
</div>

@props(['activityItem', 'hasChanges'])

<div
    @class([
        'flex justify-between items-center',
        $hasChanges ? 'cursor-pointer' : '',
    ])
    @if ($hasChanges) @click="() => isCollapsed = !isCollapsed" @endif
>
    <div class="flex items-center gap-x-2">
        @if ($activityItem->causer)
            <x-filament-panels::avatar.user
                :user="$activityItem->causer"
                class="!w-7 !h-7"
            />
        @endif
        <div class="flex flex-col text-left">
            <span class="font-semibold dark:text-gray-300">{{ $activityItem->causer?->name }}</span>
            <span class="text-xs text-gray-500 dark:text-gray-200">
                @lang("filament-activity-log::activities.events.{$activityItem->event}.description", [
                    'time' => $activityItem->created_at->translatedFormat(__('filament-activity-log::activities.time_format')),
                ])
            </span>
        </div>
    </div>

    <div class="flex gap-x-2">
        <div @class([
            'flex items-center gap-1 p-2 rounded-lg',
            'text-xs text-gray-700 bg-gray-100 font-medium',
            'dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300',
        ])>
            <span>{{ $this->getSubjectLabel($activityItem) }}</span>
            <span>#{{ $activityItem->subject_id }}</span>
        </div>

        @if ($hasChanges)
            <x-filament::icon
                icon="heroicon-m-chevron-up"
                class="h-6 w-6 text-gray-500 dark:text-gray-400 transition"
                x-bind:class="{ '-rotate-180': isCollapsed }"
            />
        @endif
    </div>
</div>

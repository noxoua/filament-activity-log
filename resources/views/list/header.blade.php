<div
    @class([
        'flex justify-between items-center group',
        $hasChanges ? 'cursor-pointer' : '',
    ])
    @if ($hasChanges) @click="() => isCollapsed = !isCollapsed" @endif
>
    <div class="flex items-center gap-x-2">
        @if ($activity->causer)
            <x-filament-panels::avatar.user
                :user="$activity->causer"
                class="!w-10 !h-10"
            />
        @endif
        <div class="flex flex-col text-left">
            <span class="font-semibold dark:text-gray-300">{{ $activity->causer?->name }}</span>
            @php
                $event = $activity->event;
                $eventStyle = match ($event) {
                    'created' => 'bg-green-50/70 dark:bg-green-100/10 text-green-700 dark:text-green-200 dark:border-green-600 dark:bg-green-700 dark:text-green-300',
                    'updated' => 'bg-blue-50/70 dark:bg-blue-100/10 text-blue-700 dark:text-blue-200 dark:border-blue-600 dark:bg-blue-700 dark:text-blue-300',
                    'deleted' => 'bg-red-50/70 dark:bg-red-100/10 text-red-700 dark:text-red-200 dark:border-red-600 dark:bg-red-700 dark:text-red-300',
                    'restored' => 'bg-orange-50/70 dark:bg-orange-100/10 text-orange-700 dark:text-orange-200 dark:border-orange-600 dark:bg-orange-700 dark:text-orange-300',
                    default => 'bg-gray-50/70 dark:bg-gray-100/10 text-gray-700 dark:text-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300',
                };
            @endphp
            <span @class([
                'px-2 py-1 rounded-full text-xs',
                'opacity-70 transition group-hover:opacity-100',
                $eventStyle,
            ])>
                @lang("filament-activity-log::activities.events.{$event}.description", [
                    'time' => $activity->created_at->translatedFormat(__('filament-activity-log::activities.time_format')),
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
            <span>{{ $this->getSubjectLabel($activity) }}</span>
            <span>#{{ $activity->subject_id }}</span>
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

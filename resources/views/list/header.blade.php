<div
    @class([
        'flex justify-between items-center',
        $hasChanges && $this->isCollapsible ? 'cursor-pointer' : '',
    ])
    @if ($hasChanges && $this->isCollapsible) @click="() => isCollapsed = !isCollapsed" @endif
>
    <div class="flex items-center gap-x-2">
        @if ($activity->causer)
            <x-filament-panels::avatar.user
                :user="$activity->causer"
                size="md"
            />
        @endif
        <div class="flex flex-col text-left">
            <span class="font-semibold dark:text-gray-300">{{ $activity->causer?->name }}</span>
            <span class="text-xs text-gray-700 dark:text-gray-200">
                {{ $activity->created_at->translatedFormat(__('filament-activity-log::activities.time_format')) }}
            </span>
        </div>
    </div>

    <div class="flex gap-x-2">
        @php
            $subject_label = $logger->getLabel();

            $event = $activity->event;
            $eventStyle = match ($event) {
                'created', 'attached' => 'bg-green-50/70 dark:bg-green-100/10 text-green-700 dark:text-green-400 dark:border-green-600',
                'updated' => 'bg-blue-50/70 dark:bg-blue-100/10 text-blue-700 dark:text-blue-400 dark:border-blue-600',
                'deleted', 'detached' => 'bg-red-50/70 dark:bg-red-100/10 text-red-700 dark:text-red-400 dark:border-red-600',
                'restored' => 'bg-orange-50/70 dark:bg-orange-100/10 text-orange-700 dark:text-orange-400 dark:border-orange-600',
                default => 'bg-gray-50/70 dark:bg-gray-100/10 text-gray-700 dark:text-gray-400 dark:border-gray-600',
            };
        @endphp

        <span @class([
            'py-2 px-4 rounded-full text-xs',
            'flex items-center',
            'opacity-70 transition group-hover:opacity-100',
            $eventStyle,
        ])>
            @lang("filament-activity-log::activities.events.{$event}.description")
        </span>

        @if ($logger->relationManager)
            <div @class([
                'flex items-center gap-1 p-2 rounded-lg',
                'text-xs text-gray-700 bg-gray-100 font-medium',
                'opacity-70 transition group-hover:opacity-100',
                'dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300',
            ])>
                <span>{{ $logger->relationManager->getLabel() }}</span>
                <span>#{{ $activity->properties['relation_manager']['id'] ?? '–' }}</span>
            </div>
        @endif

        <div @class([
            'flex items-center gap-1 p-2 rounded-lg',
            'text-xs text-gray-700 bg-gray-100 font-medium',
            'opacity-70 transition group-hover:opacity-100',
            'dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300',
        ])>
            <span>{{ $subject_label }}</span>
            <span>#{{ $activity->subject_id }}</span>
        </div>

        @if ($hasChanges && $this->isCollapsible)
            <x-filament::icon
                icon="heroicon-m-chevron-up"
                class="h-6 w-6 text-gray-500 dark:text-gray-400 transition"
                x-bind:class="{ '-rotate-180': !isCollapsed }"
            />
        @endif
    </div>
</div>

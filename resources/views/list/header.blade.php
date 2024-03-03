@php
    $event = $activity->event;
    $eventStyle = match ($event) {
        'created',
        'attached'
            => 'bg-green-50/70 dark:bg-green-100/10 text-green-700 dark:text-green-400 dark:border-green-600',
        'updated' => 'bg-blue-50/70 dark:bg-blue-100/10 text-blue-700 dark:text-blue-400 dark:border-blue-600',
        'deleted', 'detached' => 'bg-red-50/70 dark:bg-red-100/10 text-red-700 dark:text-red-400 dark:border-red-600',
        'restored'
            => 'bg-orange-50/70 dark:bg-orange-100/10 text-orange-700 dark:text-orange-400 dark:border-orange-600',
        default => 'bg-gray-50/70 dark:bg-gray-100/10 text-gray-700 dark:text-gray-400 dark:border-gray-600',
    };

    // Relation Manager
    $showRelationManager = false;
    if ($logger->relationManager) {
        $relationManagerRoute = $logger->getRelationManagerRoute($activity);
        $relationManagertLabel = $logger->getRelationManagerLabel();
        $relationManagertId = $logger->getRelationManagerId($activity);
        $showRelationManager = $relationManagertLabel || $relationManagertId;
    }

    // Subject
    $subjectRoute = $logger->getSubjectRoute($activity);
    $subjectLabel = $logger->getSubjectLabel();
    $subjectId = $logger->getSubjectId($activity);
    $showSubject = $subjectLabel || $subjectId;
@endphp

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

    @if (is_array($inlineField))
        @php
            [$field, $oldValue, $newValue] = $inlineField;
        @endphp

        <div @class([
            'flex items-center gap-8 border p-2 rounded-md dark:border-white/10',
            'opacity-70 transition group-hover:opacity-100',
        ])>
            <div>{{ $field->display($oldValue) }}</div>
            <div class="dark:text-white/70">{{ $field->getLabel() }}</div>
            <div>{{ $field->display($newValue) }}</div>
        </div>
    @endif

    <div class="flex gap-x-2">
        <span @class([
            'py-2 px-4 rounded-full text-xs',
            'flex items-center',
            'opacity-70 transition group-hover:opacity-100',
            $eventStyle,
        ])>
            @lang("filament-activity-log::activities.events.{$event}.description")
        </span>

        @if ($showRelationManager)
            <a
                @if ($relationManagerRoute) href="{{ $relationManagerRoute }}" @endif
                @class([
                    'flex items-center gap-1 p-2 rounded-lg',
                    'text-xs text-gray-700 bg-gray-100 font-medium',
                    'opacity-70 transition group-hover:opacity-100',
                    'dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300',
                ])
            >
                <span>{{ $relationManagertLabel }}</span>
                <span>{{ $relationManagertId }}</span>
            </a>
        @endif

        @if ($showSubject)
            <a
                @if ($subjectRoute) href="{{ $subjectRoute }}" @endif
                @class([
                    'flex items-center gap-1 p-2 rounded-lg',
                    'text-xs text-gray-700 bg-gray-100 font-medium',
                    'opacity-70 transition group-hover:opacity-100',
                    'dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300',
                ])
            >
                <span>{{ $subjectLabel }}</span>
                <span>{{ $subjectId }}</span>
            </a>
        @endif

        @if ($hasChanges && $this->isCollapsible)
            <x-filament::icon
                icon="heroicon-m-chevron-up"
                class="h-6 w-6 text-gray-500 dark:text-gray-400 transition"
                x-bind:class="{ '-rotate-180': !isCollapsed }"
            />
        @endif
    </div>
</div>

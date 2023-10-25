@props(['activityItem'])

<div class="p-2">
    <div class="flex justify-between">
        <div class="flex items-center gap-4">
            @if ($activityItem->causer)
                <x-filament-panels::avatar.user
                    :user="$activityItem->causer"
                    class="!w-7 !h-7"
                />
            @endif
            <div class="flex flex-col text-left">
                <span class="font-bold">{{ $activityItem->causer?->name }}</span>
                <span class="text-xs text-gray-500">
                    @lang('filament-activity-log::activities.events.' . $activityItem->event):
                    {{ $activityItem->created_at->translatedFormat(__('filament-activity-log::activities.default_datetime_format')) }}
                </span>
            </div>
        </div>
        <div class="flex flex-col justify-end">
            <div class="flex items-center gap-1">
                <span class="text-xs text-gray-500">{{ $this->getSubjectLabel($activityItem) }}</span>
                <span class="text-md text-gray-800">#{{ $activityItem->subject_id }}</span>
            </div>
        </div>
    </div>
</div>

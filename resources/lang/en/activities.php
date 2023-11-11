<?php

return [
    'title' => 'Activity history',

    'date_format' => 'j F, Y',
    'time_format' => 'H:i l',

    'filters' => [
        'date' => 'Date',
        'causer' => 'Initiator',
        'subject_type' => 'Subject',
        'subject_id' => 'Subject ID',
        'event' => 'Action',
    ],
    'table' => [
        'field' => 'Field',
        'old' => 'Old',
        'new' => 'New',
        'value' => 'Value',
        'no_records_yet' => 'There are no entries yet',
    ],
    'events' => [
        'created' => [
            'title' => 'Created',
            'description' => 'Entry created',
        ],
        'updated' => [
            'title' => 'Updated',
            'description' => 'Entry updated',
        ],
        'deleted' => [
            'title' => 'Deleted',
            'description' => 'Entry deleted',
        ],
        'restored' => [
            'title' => 'Restored',
            'description' => 'Entry restored',
        ],
        'attached' => [
            'title' => 'Attached',
            'description' => 'Entry attached',
        ],
        'detached' => [
            'title' => 'Detached',
            'description' => 'Entry detached',
        ],
        // Your custom events...
    ],
    'boolean' => [
        'true' => 'True',
        'false' => 'False',
    ],
];

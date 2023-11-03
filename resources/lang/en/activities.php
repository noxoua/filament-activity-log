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
        'updated' => [
            'title' => 'Updated',
            'description' => 'The record was updated at <b>:time</b>',
        ],
        'created' => [
            'title' => 'Created',
            'description' => 'The record was created at <b>:time</b>',
        ],
        'deleted' => [
            'title' => 'Deleted',
            'description' => 'Record was deleted at <b>:time</b>',
        ],
        'restored' => [
            'title' => 'Restored',
            'description' => 'Record was restored at <b>:time</b>',
        ],
        // Your custom events...
    ],
    'boolean' => [
        'true' => 'True',
        'false' => 'False',
    ],
];

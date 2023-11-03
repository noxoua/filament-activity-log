<?php

return [
    'title' => 'Історія діяльності',

    'date_format' => 'j F, Y',
    'time_format' => 'H:i l',

    'filters' => [
        'date' => 'Дата',
        'causer' => 'Ініціатор',
        'subject_type' => 'Об\'єкт',
        'subject_id' => 'ID об\'єкту',
        'event' => 'Дія',
    ],
    'table' => [
        'field' => 'Поле',
        'old' => 'Старе',
        'new' => 'Нове',
        'value' => 'Значення',
        'no_records_yet' => 'Поки що немає записів',
    ],
    'events' => [
        'updated' => [
            'title' => 'Оновлено',
            'description' => 'Запис було оновлено в <b>:time</b>',
        ],
        'created' => [
            'title' => 'Створено',
            'description' => 'Запис було створено в <b>:time</b>',
        ],
        'deleted' => [
            'title' => 'Видалено',
            'description' => 'Запис було видалено в <b>:time</b>',
        ],
        'restored' => [
            'title' => 'Відновлено',
            'description' => 'Запис було відновлено в <b>:time</b>',
        ],
        // Your custom events...
    ],
    'boolean' => [
        'true' => 'Так',
        'false' => 'Ні',
    ],
];

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
        'created' => [
            'title' => 'Створено',
            'description' => 'Запис створено',
        ],
        'updated' => [
            'title' => 'Оновлено',
            'description' => 'Запис оновлено',
        ],
        'deleted' => [
            'title' => 'Видалено',
            'description' => 'Запис видалено',
        ],
        'restored' => [
            'title' => 'Відновлено',
            'description' => 'Запис відновлено',
        ],
        'attached' => [
            'title' => 'Прикріплено',
            'description' => 'Запис прикріплено',
        ],
        'detached' => [
            'title' => 'Відокремлено',
            'description' => 'Запис відокремлено',
        ],
        // Your custom events...
    ],
    'boolean' => [
        'true' => 'Так',
        'false' => 'Ні',
    ],
];

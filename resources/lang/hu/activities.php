<?php

return [
    'title' => 'Esemény napló',

    'date_format' => 'Y F j',
    'time_format' => 'H:i l',

    'filters' => [
        'date' => 'Dátum',
        'causer' => 'Felhasználó',
        'subject_type' => 'Adat típus',
        'subject_id' => 'Adat azonosító',
        'event' => 'Esemény',
    ],
    'table' => [
        'field' => 'Adat',
        'old' => 'Előző értékek',
        'new' => 'Új értékek',
        'value' => 'Érték',
        'no_records_yet' => 'Nincs megjeleníthető elem',
    ],
    'events' => [
        'created' => [
            'title' => 'Létrehozás',
            'description' => 'Létrehozva',
        ],
        'updated' => [
            'title' => 'Módosítás',
            'description' => 'Módosítva',
        ],
        'deleted' => [
            'title' => 'Törlés',
            'description' => 'Törölve',
        ],
        'restored' => [
            'title' => 'Visszaállítás',
            'description' => 'Adat visszaállítva',
        ],
        'attached' => [
            'title' => 'Csatolás',
            'description' => 'Csatolva',
        ],
        'detached' => [
            'title' => 'Leválasztás',
            'description' => 'Leválasztva',
        ],
        // Your custom events...
    ],
    'boolean' => [
        'true' => 'Igen', // Igaz
        'false' => 'Nem', // Hamis
    ],
];

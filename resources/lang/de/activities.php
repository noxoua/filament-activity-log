<?php

return [
    'title' => 'Aktivitätsverlauf',

    'date_format' => 'j F, Y',
    'time_format' => 'H:i l',

    'filters' => [
        'date' => 'Datum',
        'causer' => 'Initiator',
        'subject_type' => 'Betreff',
        'subject_id' => 'Betreff ID',
        'event' => 'Aktion',
    ],
    'table' => [
        'field' => 'Feld',
        'old' => 'Alt',
        'new' => 'Neu',
        'Wert' => 'Wert',
        'no_records_yet' => 'Es sind noch keine Einträge vorhanden',
    ],
    'events' => [
        'created' => [
            'title' => 'Erstellt',
            'description' => 'Eintrag erstellt',
        ],
        'updated' => [
            'title' => 'Aktualisiert',
            'description' => 'Eintrag aktualisiert',
        ],
        'deleted' => [
            'title' => 'Gelöscht',
            'description' => 'Eintrag gelöscht',
        ],
        'restored' => [
            'title' => 'Wiederhergestellt',
            'description' => 'Eintrag wiederhergestellt',
        ],
        'attached' => [
            'title' => 'Angehängt',
            'description' => 'Eintrag angehängt',
        ],
        'detached' => [
            'title' => 'Freistehend',
            'description' => 'Eintrag getrennt',
        ],
        // Your custom events...
    ],
    'boolean' => [
        'true' => 'True',
        'false' => 'Falsch',
    ],
];

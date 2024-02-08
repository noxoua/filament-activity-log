<?php

use Noxo\FilamentActivityLog\ResourceLogger\Types\BooleanEnum;

return [
    'loggers' => [
        'panels' => [
        /**
         * Add different admin panels with its directory and namespace. E.g:
         *    'panel-1' => [
         *       'directory' => app_path('Filament/Panel1/Loggers'),
         *       'namespace' => 'App\\Filament\\Panel1\\Loggers',
         *    ]
         */
        ],
        // Default panel
        'directory' => app_path('Filament/Loggers'),
        'namespace' => 'App\\Filament\\Loggers',
    ],

    'boolean' => BooleanEnum::class,
];

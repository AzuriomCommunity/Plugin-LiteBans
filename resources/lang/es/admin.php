<?php

return [
    'nav' => [
        'title' => 'LiteBans',

        'settings' => 'Configuración',
    ],

    'permission' => [
        "all" => 'Ver y modificar la configuración de Litebans',
        "bans" => "Litebans - See bans",
        "mutes" => "Litebans - See mutes",
        "kicks" => "Litebans - See kicks",
        "warn" => "Litebans - See warns",
        "player" => "Litebans - See others players"
    ],

    'settings' => [
        'title' => 'Configuración del plugin Litebans',
        'database-connect' => 'Conexión a la base de datos',
        'other-settings' => 'Otros ajustes',

        'host' => 'Alojamiento',
        'port' => 'Puerto',
        'database' => 'Base de Datos',
        'username' => 'Nombre de Usuario',
        'password' => 'Contraseña',
        'perpage' => 'Sanciones por Página',
        'prefix' => 'Prefijo de la Tabla',
        'features' => [
            'title' => 'Features enabled',
            'kicks' => 'Kicks enabled',
            'mutes' => 'Mutes enabled',
            'warns' => 'Warns enabled'
        ]
    ],
];

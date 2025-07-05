<?php

return [
    'nav' => [
        'title' => 'LiteBans',

        'settings' => 'Paramètres',
    ],

    'permission' => [
        "all" => 'Voir et modifier les paramètres du plugin LiteBans',
        "bans" => "Litebans - Voir les bannissements",
        "mutes" => "Litebans - Voir les mutes",
        "kicks" => "Litebans - Voir les exclusions",
        "warn" => "Litebans - Voir les avertissements",
        "player" => "Litebans - Voir les autres joueurs"
    ],

    'settings' => [
        'title' => 'Paramètres du plugin LiteBans',
        'database-connect' => 'Connexion à la base de données',
        'other-settings' => 'Autres paramètres',

        'host' => 'Hôte',
        'port' => 'Port',
        'database' => 'Base de données',
        'username' => 'Nom d\'utilisateur',
        'password' => 'Mot de passe',
        'perpage' => 'Nombre de sanctions par page',
        'prefix' => 'Table prefix',
        'features' => [
            'title' => 'Fonctionnalité activées',
            'kicks' => 'Kicks activé',
            'mutes' => 'Mutes activé',
            'warns' => 'Avertissements activé'
        ]
    ],
];

<?php

declare(strict_types=1);

return [
    'plugin' => [
        'name' => 'VDLP Basic Authentication',
        'description' => 'VDLP basis authenticatie.',
    ],
    'settings' => [
        'label' => 'VDLP Basic Authentication',
        'description' => 'Instellingen voor de VDLP basis authenticatie.',
    ],
    'input' => [
        'enabled_label' => 'Ingeschakeld',
        'username_label' => 'Gebruikersnaam',
        'password_label' => 'Wachtwoord',
        'realm_label' => 'Realm',
        'hostname_label' => 'Hostname',
        'url_label' => 'Url',
    ],
    'output' => [
        'unauthorized' => 'U heeft geen toegang tot deze omgeving.',
    ],
    'permissions' => [
        'access_settings' => [
            'label' => 'Beheren van instellingen',
            'tab' => 'Basis authenticatie',
        ],
    ],
    'credentials' => [
        'form' => [
            'record_name_singular' => 'Record',
            'record_name_plural' => 'Credentials',
            'create_title' => 'Nieuwe credentials',
            'edit_title' => 'Wijzigen credentials',
            'delete_confirm' => 'Weet je zeker dat je deze credentials wilt verwijderen?',
            'return_to_list' => 'Terug naar credentials lijst',
        ],
        'list' => [
            'title' => 'Beheren credentials',
            'create_button' => 'Nieuwe credentials',
        ],
    ],
    'excludedurls' => [
        'label' => 'VDLP Basic Authentication Excluded Urls',
        'description' => 'Instellingen voor de VDLP basis authenticatie.',
        'form' => [
            'record_name_singular' => 'Excluded url',
            'record_name_plural' => 'Excluded urls',
            'create_title' => 'Nieuwe excluded url',
            'edit_title' => 'Wijzigen excluded url',
            'delete_confirm' => 'Weet je zeker dat je deze excluded url wilt verwijderen?',
            'return_to_list' => 'Terug naar excluded urls lijst',
        ],
        'list' => [
            'title' => 'Beheren excluded urls',
            'create_button' => 'Nieuwe excluded url',
        ],
    ],
];

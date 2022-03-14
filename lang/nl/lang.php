<?php

declare(strict_types=1);

return [
    'plugin' => [
        'name' => 'Basic Authentication',
        'description' => 'Beveilig je website met Basic Authentication.',
    ],
    'settings' => [
        'label' => 'Basic Authentication',
        'description' => 'Beheer Basic Authentication instellingen.',
    ],
    'input' => [
        'enabled_label' => 'Ingeschakeld',
        'username_label' => 'Gebruikersnaam',
        'password_label' => 'Wachtwoord',
        'password_confirmation_label' => 'Bevestig wachtwoord',
        'realm_label' => 'Omgeving',
        'hostname_label' => 'Hostnaam',
        'hostname_comment' => 'Bijvoorbeeld: staging.example.com',
        'whitelist_label' => 'Whitelist',
        'whitelist_comment' => 'Paden in de whitelist worden niet beveiligd met Basic Authentication credentials.',
        'whitelist_prompt' => 'Nieuw pad toevoegen aan whitelist',
        'absolute_path_label' => 'Absoluut pad',
        'absolute_path_comment' => 'Bijvoorbeeld: /api/v1/authenticate',
    ],
    'output' => [
        'unauthorized' => 'Ongeautoriseerde toegang is geweigerd.',
    ],
    'validation' => [
        'hostname_unique' => 'Hostnaam bestaat reeds.',
    ],
    'permissions' => [
        'access_settings' => [
            'label' => 'Beheer instellingen',
            'tab' => 'Basic Authentication',
        ],
    ],
    'credentials' => [
        'form' => [
            'record_name_singular' => 'credential',
            'record_name_plural' => 'Credentials',
            'create_title' => 'Nieuwe credentials',
            'edit_title' => 'Wijzig credentials',
            'delete_confirm' => 'Weet je het zeker?',
            'return_to_list' => 'Terug naar overzicht',
        ],
        'list' => [
            'title' => 'Beheer credentials',
            'create_button' => 'Nieuwe credentials',
        ],
    ],
    'notifications' => [
        'disabled' => 'Basic Authentication is uitgeschakeld, je kunt dit inschakelen via het configuratie bestand. Lees het README bestand voor meer informatie.',
    ],
];

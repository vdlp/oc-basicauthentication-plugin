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
        'realm_label' => 'Omgeving',
        'hostname_label' => 'Hostnaam',
        'url_label' => 'URL',
        'url_comment' => 'De volledige URL die wordt uitgesloten. Bijv. https://example.com/pad/ander-path',
    ],
    'output' => [
        'unauthorized' => 'Ongeautoriseerde toegang is geweigerd.',
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
    'excludedurls' => [
        'label' => 'Basic Authentication uitgesloten URLs',
        'description' => 'Setup voor basic authentication.',
        'form' => [
            'record_name_singular' => 'Uitgesloten URL',
            'record_name_plural' => 'Uitgesloten URLs',
            'create_title' => 'Nieuwe uitgesloten URL',
            'edit_title' => 'Wijzig uitgesloten URL',
            'delete_confirm' => 'Weet je het zeker?',
            'return_to_list' => 'Terug naar overzicht',
        ],
        'list' => [
            'title' => 'Beheer uitgesloten URLs',
            'create_button' => 'Nieuwe uitgesloten URL',
        ],
    ],
    'notifications' => [
        'disabled' => 'Basic Authentication is uitgeschakeld, je kunt dit inschakelen via het configuratie bestand. Lees het README bestand voor meer informatie.',
    ],
];

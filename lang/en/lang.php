<?php

declare(strict_types=1);

return [
    'plugin' => [
        'name' => 'Basic Authentication',
        'description' => 'Protect your website with Basic Authentication.',
    ],
    'settings' => [
        'label' => 'Basic Authentication',
        'description' => 'Manage Basic Authentication settings.',
    ],
    'input' => [
        'enabled_label' => 'Enabled',
        'username_label' => 'Username',
        'password_label' => 'Password',
        'realm_label' => 'Realm',
        'hostname_label' => 'Hostname',
        'url_label' => 'URL',
    ],
    'output' => [
        'unauthorized' => 'Unauthorized access is not allowed.',
    ],
    'permissions' => [
        'access_settings' => [
            'label' => 'Manage settings',
            'tab' => 'Basic Authentication',
        ],
    ],
    'credentials' => [
        'form' => [
            'record_name_singular' => 'credential',
            'record_name_plural' => 'Credentials',
            'create_title' => 'New credentials',
            'edit_title' => 'Edit credentials',
            'delete_confirm' => 'Are you sure?',
            'return_to_list' => 'Back to list',
        ],
        'list' => [
            'title' => 'Manage credentials',
            'create_button' => 'New credentials',
        ],
    ],
    'excludedurls' => [
        'label' => 'Basic Authentication Excluded URLs',
        'description' => 'Setup for basic authentication.',
        'form' => [
            'record_name_singular' => 'Excluded URL',
            'record_name_plural' => 'Excluded URLs',
            'create_title' => 'New excluded URL',
            'edit_title' => 'Edit excluded URL',
            'delete_confirm' => 'Are you sure?',
            'return_to_list' => 'Back to list',
        ],
        'list' => [
            'title' => 'Manage excluded URLs',
            'create_button' => 'New excluded URL',
        ],
    ],
    'notifications' => [
        'disabled' => 'Basic Authentication is disabled, you can enable it in the configuration file. Read the README for more information.',
    ],
];

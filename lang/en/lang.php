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
        'password_confirmation_label' => 'Confirm Password',
        'realm_label' => 'Realm',
        'hostname_label' => 'Hostname',
        'hostname_comment' => 'For example: staging.example.com',
        'whitelist_label' => 'Whitelist',
        'whitelist_comment' => 'Whitelisted paths will not be protected with Basic Authentication credentials.',
        'whitelist_prompt' => 'Add new path to whitelist',
        'absolute_path_label' => 'Absolute path',
        'absolute_path_comment' => 'For example: /api/v1/authenticate',
    ],
    'output' => [
        'unauthorized' => 'Unauthorized access is not allowed.',
    ],
    'validation' => [
        'hostname_unique' => 'Hostname already exists.',
    ],
    'permissions' => [
        'access_settings' => [
            'label' => 'Manage settings',
            'tab' => 'Basic Authentication',
        ],
    ],
    'credentials' => [
        'form' => [
            'record_name_singular' => 'Credential',
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
    'notifications' => [
        'disabled' => 'Basic Authentication is disabled, you can enable it in the configuration file. Check README for instructions.',
    ],
];

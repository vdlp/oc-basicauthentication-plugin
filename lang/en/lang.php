<?php

declare(strict_types=1);

return [
    'plugin' => [
        'name' => 'VDLP Basic Authentication',
        'description' => 'VDLP basic authentication.',
    ],
    'settings' => [
        'label' => 'VDLP Basic Authentication',
        'description' => 'Setup for the VDLP basic authentication.',
    ],
    'input' => [
        'enabled_label' => 'Enabled',
        'username_label' => 'Username',
        'password_label' => 'Password',
        'realm_label' => 'Realm',
        'hostname_label' => 'Hostname',
        'url_label' => 'Url',
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
        'label' => 'VDLP Basic Authentication Excluded Urls',
        'description' => 'Setup for the VDLP basic authentication.',
        'form' => [
            'record_name_singular' => 'Excluded url',
            'record_name_plural' => 'Excluded urls',
            'create_title' => 'New excluded url',
            'edit_title' => 'Edit excluded url',
            'delete_confirm' => 'Are you sure?',
            'return_to_list' => 'Back to list',
        ],
        'list' => [
            'title' => 'Manage excluded urls',
            'create_button' => 'New excluded url',
        ],
    ],
];

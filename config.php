<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Basic Authentication enabled
    |--------------------------------------------------------------------------
    |
    | Enable the Basic Authentication plugin by adding the
    | BASIC_AUTHENTICATION_ENABLED to your .env file.
    |
    */

    'enabled' => (bool) env('BASIC_AUTHENTICATION_ENABLED', false),

    /*
    |--------------------------------------------------------------------------
    | White Listed IP addresses
    |--------------------------------------------------------------------------
    |
    | Provide a comma separated list of IP addresses to whitelist.
    |
    */

    'whitelisted_ips' => env('BASIC_AUTHENTICATION_WHITELISTED_IPS', ''),

];

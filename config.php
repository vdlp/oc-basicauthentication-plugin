<?php

declare(strict_types=1);

return [
    'enabled' => (bool) env('BASIC_AUTHENTICATION_ENABLED', false),
    'whitelisted_ips' => env('BASIC_AUTHENTICATION_WHITELISTED_IPS', ''),
];

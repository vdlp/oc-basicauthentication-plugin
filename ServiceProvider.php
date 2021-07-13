<?php

declare(strict_types=1);

namespace Vdlp\BasicAuthentication;

use October\Rain\Support\ServiceProvider as ServiceProviderBase;

final class ServiceProvider extends ServiceProviderBase
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/config.php' => config_path('basicauthentication.php'),
        ], 'config');

        $this->mergeConfigFrom(__DIR__ . '/config.php', 'basicauthentication');
    }
}

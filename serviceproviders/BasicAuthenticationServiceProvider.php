<?php

declare(strict_types=1);

namespace Vdlp\BasicAuthentication\ServiceProviders;

use Illuminate\Support\ServiceProvider;

final class BasicAuthenticationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config.php' => config_path('basicauthentication.php'),
        ], 'config');

        $this->mergeConfigFrom(__DIR__ . '/../config.php', 'basicauthentication');
    }
}

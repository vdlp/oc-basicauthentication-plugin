<?php

declare(strict_types=1);

namespace Vdlp\BasicAuthentication\ServiceProviders;

use October\Rain\Support\ServiceProvider;

/**
 * Class BasicAuthenticationServiceProvider
 *
 * @package Vdlp\BasicAuthentication\ServiceProviders
 */
class BasicAuthenticationServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config.php' => config_path('basicauthentication.php'),
        ], 'config');

        $this->mergeConfigFrom(__DIR__ . '/../config.php', 'basicauthentication');
    }
}

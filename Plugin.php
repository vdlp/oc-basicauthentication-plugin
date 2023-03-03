<?php

declare(strict_types=1);

namespace Vdlp\BasicAuthentication;

use Backend\Helpers\Backend as BackendHelper;
use Illuminate\Contracts\Http\Kernel;
use System\Classes\PluginBase;
use Vdlp\BasicAuthentication\Console\CreateCredentialsCommand;
use Vdlp\BasicAuthentication\Http\Middleware\BasicAuthenticationMiddleware;
use Vdlp\BasicAuthentication\ServiceProviders\BasicAuthenticationServiceProvider;

final class Plugin extends PluginBase
{
    public function pluginDetails(): array
    {
        return [
            'name' => 'vdlp.basicauthentication::lang.plugin.name',
            'description' => 'vdlp.basicauthentication::lang.plugin.description',
            'author' => 'Van der Let & Partners',
            'icon' => 'icon-lock',
        ];
    }

    public function boot(): void
    {
        if (
            (bool) config('basicauthentication.enabled', false) === false
            || $this->app->runningInConsole()
            || $this->app->runningUnitTests()
        ) {
            return;
        }

        $this->app[Kernel::class]
            ->pushMiddleware(BasicAuthenticationMiddleware::class);
    }

    public function register(): void
    {
        $this->app->register(BasicAuthenticationServiceProvider::class);

        $this->registerConsoleCommand(CreateCredentialsCommand::class, CreateCredentialsCommand::class);
    }

    public function registerPermissions(): array
    {
        return [
            'vdlp.basicauthentication.access_settings' => [
                'label' => 'vdlp.basicauthentication::lang.permissions.access_settings.label',
                'tab' => 'vdlp.basicauthentication::lang.permissions.access_settings.tab',
            ],
        ];
    }

    public function registerSettings(): array
    {
        /** @var BackendHelper $backendHelper */
        $backendHelper = resolve(BackendHelper::class);

        return [
            'credentials' => [
                'label' => 'vdlp.basicauthentication::lang.settings.label',
                'description' => 'vdlp.basicauthentication::lang.settings.description',
                'url' => $backendHelper->url('vdlp/basicauthentication/credentials'),
                'category' => 'Basic Authentication',
                'icon' => 'icon-lock',
                'permissions' => ['vdlp.basicauthentication.*'],
                'keywords' => 'basic authentication security',
                'order' => 500,
            ],
        ];
    }
}

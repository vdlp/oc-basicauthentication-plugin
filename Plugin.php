<?php

declare(strict_types=1);

namespace Vdlp\BasicAuthentication;

use Backend\Helpers\Backend as BackendHelper;
use Illuminate\Routing\Router;
use October\Rain\Foundation\Application;
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

    public function register(): void
    {
        $this->app->register(BasicAuthenticationServiceProvider::class);

        $this->registerConsoleCommand(CreateCredentialsCommand::class, CreateCredentialsCommand::class);
    }

    public function boot(): void
    {
        /** @var Application $application */
        $application = $this->app;

        if (
            (bool) config('basicauthentication.enabled', false) === false
            || $application->runningInConsole()
            || $application->runningUnitTests()
        ) {
            return;
        }

        /** @var Router $router */
        $router = $application->make(Router::class);
        $router->pushMiddlewareToGroup('web', BasicAuthenticationMiddleware::class);
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

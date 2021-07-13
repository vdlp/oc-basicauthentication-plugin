<?php

declare(strict_types=1);

namespace Vdlp\BasicAuthentication;

use Backend\Helpers\Backend as BackendHelper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Exception\SuspiciousOperationException;
use System\Classes\PluginBase;
use Vdlp\BasicAuthentication\Classes\AuthorizationHelper;
use Vdlp\BasicAuthentication\Console\CreateCredentialsCommand;
use Vdlp\BasicAuthentication\Models\Credential;

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
        $this->app->register(ServiceProvider::class);

        $this->registerConsoleCommand(CreateCredentialsCommand::class, CreateCredentialsCommand::class);
    }

    /**
     * {@inheritdoc}
     *
     * @throws SuspiciousOperationException
     */
    public function boot(): void
    {
        if (
            !config('basicauthentication.enabled')
            || app()->runningInConsole()
            || app()->runningUnitTests()
            || app()->runningInBackend()
        ) {
            return;
        }

        /** @var AuthorizationHelper $authorizationHelper */
        $authorizationHelper = resolve(AuthorizationHelper::class);

        /** @var Request $request */
        $request = resolve(Request::class);

        if ($authorizationHelper->isIpAddressWhitelisted((string) $request->ip())) {
            return;
        }

        try {
            /** @var Credential $credential */
            $credential = Credential::query()
                ->where('hostname', '=', $request->getHost())
                ->where('is_enabled', '=', true)
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return;
        }

        if ($authorizationHelper->isUrlExcluded($request->getUri())) {
            return;
        }

        $sessionKey = str_slug(str_replace('.', '_', $credential->getAttribute('hostname')) . '_basic_authentication');

        if (session()->has($sessionKey)) {
            return;
        }

        if (
            $request->getUser() === $credential->getAttribute('username')
            && $request->getPassword() === $credential->getAttribute('password')
        ) {
            session()->put($sessionKey, $request->getUser());

            return;
        }

        header('WWW-Authenticate: Basic realm="' . $credential->getAttribute('realm') . '"');
        header('HTTP/1.0 401 Unauthorized');

        echo (string) trans('vdlp.basicauthentication::lang.output.unauthorized');
        exit(0);
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
            'excludedurls' => [
                'label' => 'vdlp.basicauthentication::lang.excludedurls.label',
                'description' => 'vdlp.basicauthentication::lang.excludedurls.description',
                'url' => $backendHelper->url('vdlp/basicauthentication/excludedurls'),
                'category' => 'Basic Authentication',
                'icon' => 'icon-link',
                'permissions' => ['vdlp.basicauthentication.*'],
                'keywords' => 'basic authentication security',
                'order' => 501,
            ],
        ];
    }
}

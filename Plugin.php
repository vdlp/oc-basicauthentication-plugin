<?php

declare(strict_types=1);

namespace Vdlp\BasicAuthentication;

use Backend\Helpers\Backend as BackendHelper;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use October\Rain\Translation\Translator;
use Symfony\Component\HttpFoundation\Exception\SuspiciousOperationException;
use System\Classes\PluginBase;
use Vdlp\BasicAuthentication\Classes\Helper\AuthorizationHelper;
use Vdlp\BasicAuthentication\Models\Credential;
use Vdlp\BasicAuthentication\ServiceProviders\BasicAuthenticationServiceProvider;

/**
 * Class Plugin
 *
 * @package Vdlp\BasicAuthentication
 */
class Plugin extends PluginBase
{
    /**
     * {@inheritdoc}
     */
    public function pluginDetails(): array
    {
        return [
            'name' => 'vdlp.basicauthentication::lang.plugin.name',
            'description' => 'vdlp.basicauthentication::lang.plugin.description',
            'author' => 'Van der Let & Partners',
            'icon' => 'icon-lock',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        $this->app->register(BasicAuthenticationServiceProvider::class);
    }

    /**
     * {@inheritdoc}
     * @throws SuspiciousOperationException
     */
    public function boot()
    {
        /** @var Repository $config */
        $config = resolve(Repository::class);

        if (!$config->get('basicauthentication.enabled')
            || app()->runningInConsole()
            || app()->runningUnitTests()
            || app()->runningInBackend()
        ) {
            return;
        }

        /** @var Request $request */
        $request = resolve(Request::class);

        /** @var Session $session */
        $session = resolve(Session::class);

        /** @var Translator $translator */
        $translator = resolve('translator');

        /** @var AuthorizationHelper $authorizationHelper */
        $authorizationHelper = resolve(AuthorizationHelper::class);
        if ($authorizationHelper->isIpAddressWhitelisted($request->ip())) {
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
        if ($session->has($sessionKey)) {
            return;
        }

        if ($request->getUser() === $credential->getAttribute('username')
            && $request->getPassword() === $credential->getAttribute('password')
        ) {
            $session->put($sessionKey, $request->getUser());
            return;
        }

        header('WWW-Authenticate: Basic realm="' . $credential->getAttribute('realm') . '"');
        header('HTTP/1.0 401 Unauthorized');

        echo $translator->get('vdlp.basicauthentication::lang.output.unauthorized');
        exit;
    }

    /**
     * {@inheritdoc}
     */
    public function registerPermissions(): array
    {
        return [
            'vdlp.basicauthentication.access_settings' => [
                'label' => 'vdlp.basicauthentication::lang.permissions.access_settings.label',
                'tab' => 'vdlp.basicauthentication::lang.permissions.access_settings.tab',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
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

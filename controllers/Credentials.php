<?php

declare(strict_types=1);

namespace Vdlp\BasicAuthentication\Controllers;

use Backend\Behaviors\FormController;
use Backend\Behaviors\ListController;
use Backend\Classes\Controller;
use Backend\Classes\NavigationManager;
use Illuminate\Contracts\Config\Repository;
use System\Classes\SettingsManager;

/**
 * @mixin ListController
 * @mixin FormController
 */
final class Credentials extends Controller
{
    public $implement = [
        FormController::class,
        ListController::class,
    ];

    public string $formConfig = 'config_form.yaml';
    public string $listConfig = 'config_list.yaml';
    public bool $enabled;
    public $requiredPermissions = ['vdlp.basicauthentication.access_settings'];

    public function __construct(Repository $config)
    {
        parent::__construct();

        NavigationManager::instance()->setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('Vdlp.BasicAuthentication', 'credentials');

        $this->enabled = (bool) $config->get('basicauthentication.enabled', false);
    }
}

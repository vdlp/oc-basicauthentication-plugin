<?php

declare(strict_types=1);

namespace Vdlp\BasicAuthentication\Controllers;

use Backend\Behaviors\FormController;
use Backend\Behaviors\ListController;
use Backend\Classes\NavigationManager;
use Backend\Classes\Controller;
use Illuminate\Contracts\Config\Repository;
use System\Classes\SettingsManager;

/**
 * Class Credentials
 *
 * Credentials Back-end Controller.
 *
 * @package Vdlp\BasicAuthentication\Controllers
 * @mixin ListController
 * @mixin FormController
 */
class Credentials extends Controller
{
    /** {@inheritdoc} */
    public $implement = [
        FormController::class,
        ListController::class,
    ];

    /** @var string */
    public $formConfig = 'config_form.yaml';

    /** @var string */
    public $listConfig = 'config_list.yaml';

    /** {@inheritdoc} */
    public $requiredPermissions = ['vdlp.basicauthentication.access_settings'];

    /** @var bool */
    public $enabled;

    /**
     * {@inheritdoc}
     */
    public function __construct(Repository $config)
    {
        parent::__construct();

        NavigationManager::instance()->setContext('October.System', 'system', 'settings');
        SettingsManager::setContext('Vdlp.BasicAuthentication', 'credentials');

        $this->enabled = $config->get('basicauthentication.enabled');
    }
}

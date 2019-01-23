<?php

declare(strict_types=1);

namespace Vdlp\BasicAuthentication\Classes\Helper;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Exception\SuspiciousOperationException;
use Vdlp\BasicAuthentication\Models\ExcludedUrl;

/**
 * Class AuthorizationHelper
 *
 * @package Vdlp\BasicAuthentication\Classes\Helper
 */
class AuthorizationHelper
{
    /**
     * @var Repository
     */
    private $config;

    /**
     * @var Request
     */
    private $request;

    /**
     * @param Repository $config
     * @param Request $request
     */
    public function __construct(Repository $config, Request $request)
    {
        $this->config = $config;
        $this->request = $request;
    }

    /**
     * @param string $currentUrl
     * @return bool
     * @throws SuspiciousOperationException
     */
    public function isUrlExcluded(string $currentUrl): bool
    {
        $currentUrl = parse_url($currentUrl);

        $excludedUrls = ExcludedUrl::all();
        foreach ($excludedUrls as $excludedUrl) {
            $excludedUrl = parse_url($excludedUrl->getAttribute('url'));
            if (array_key_exists('host', $excludedUrl) && $excludedUrl['host'] !== $this->request->getHost()) {
                continue;
            }

            if (array_key_exists('path', $excludedUrl)
                && array_key_exists('path', $currentUrl)
                && $excludedUrl['path'] === $currentUrl['path']
            ) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $ipAddress
     * @return bool
     */
    public function isIpAddressWhitelisted(string $ipAddress): bool
    {
        return in_array($ipAddress, explode(',', $this->config->get('basicauthentication.whitelisted_ips')), true);
    }
}

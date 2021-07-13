<?php

declare(strict_types=1);

namespace Vdlp\BasicAuthentication\Classes;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Exception\SuspiciousOperationException;
use Vdlp\BasicAuthentication\Models\ExcludedUrl;

final class AuthorizationHelper
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @throws SuspiciousOperationException
     */
    public function isUrlExcluded(string $currentUrl): bool
    {
        /** @var array|mixed $parsedCurrentUrl */
        $parsedCurrentUrl = parse_url($currentUrl);

        if (!is_array($parsedCurrentUrl)) {
            return false;
        }

        /** @var ExcludedUrl[] $excludedUrls */
        $excludedUrls = ExcludedUrl::all();

        foreach ($excludedUrls as $excludedUrl) {
            /** @var array|mixed $parsedExcludedUrl */
            $parsedExcludedUrl = parse_url($excludedUrl->getAttribute('url'));

            if (!is_array($parsedExcludedUrl)) {
                continue;
            }

            $host = $parsedCurrentUrl['host'] ?? '';

            if (
                array_key_exists('host', $parsedExcludedUrl)
                && $host !== $this->request->getHost()
            ) {
                continue;
            }

            if (
                array_key_exists('path', $parsedExcludedUrl)
                && array_key_exists('path', $parsedCurrentUrl)
                && $parsedExcludedUrl['path'] === $parsedCurrentUrl['path']
            ) {
                return true;
            }
        }

        return false;
    }

    public function isIpAddressWhitelisted(string $ipAddress): bool
    {
        return in_array($ipAddress, explode(',', config('basicauthentication.whitelisted_ips')), true);
    }
}

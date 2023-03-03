<?php

declare(strict_types=1);

namespace Vdlp\BasicAuthentication\Http\Middleware;

use Closure;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Throwable;
use Vdlp\BasicAuthentication\Models\Credential;

final class BasicAuthenticationMiddleware
{
    public function __construct(
        private Translator $translator,
        private Hasher $hasher,
    ) {
    }

    public function handle(Request $request, Closure $next): mixed
    {
        if ($this->isIpAddressWhitelisted((string) $request->ip())) {
            return $next($request);
        }

        try {
            /** @var Credential $credential */
            $credential = Credential::query()
                ->where('hostname', $request->getHost())
                ->where('is_enabled', true)
                ->firstOrFail(['hostname', 'username', 'password', 'realm', 'whitelist']);
        } catch (Throwable) {
            // @ignoreException
            return $next($request);
        }

        $path = Str::replaceFirst($request->getSchemeAndHttpHost(), '', $request->getUri());

        // Current URI excluded so authorisation is not required.
        if ($this->isPathWhitelisted($path, $credential)) {
            return $next($request);
        }

        $needsRehash = $this->hasher->needsRehash($credential->password);

        // Validate credentials.
        if ($request->getUser() === $credential->username) {
            // Check unhashed password.
            if ($needsRehash && $request->getPassword() !== $credential->password) {
                return $this->getUnauthorizedResponse($credential);
            }

            // Check hashed password.
            if (!$needsRehash && !$this->hasher->check((string) $request->getPassword(), $credential->password)) {
                return $this->getUnauthorizedResponse($credential);
            }

            return $next($request);
        }

        return $this->getUnauthorizedResponse($credential);
    }

    private function getUnauthorizedResponse(Credential $credential): Response
    {
        return new Response(
            $this->translator->get('vdlp.basicauthentication::lang.output.unauthorized'),
            401,
            [
                'WWW-Authenticate' => sprintf('Basic realm="%s"', $credential->realm),
            ]
        );
    }

    private function isPathWhitelisted(string $absolutePath, Credential $credential): bool
    {
        if ($credential->whitelist === null) {
            return false;
        }

        foreach ($credential->whitelist as $whitelist) {
            $type = $whitelist['matching_type'] ?? 'exact';
            $whitelistAbsolutePath = (string) ($whitelist['absolute_path'] ?? '');

            switch ($type) {
                case 'exact':
                    return $absolutePath === $whitelistAbsolutePath;
                case 'starts_with':
                    return Str::startsWith($absolutePath, $whitelistAbsolutePath);
                default:
                    break;
            }
        }

        return false;
    }

    private function isIpAddressWhitelisted(string $ipAddress): bool
    {
        return in_array(
            $ipAddress,
            explode(',', (string) config('basicauthentication.whitelisted_ips', '')),
            true
        );
    }
}

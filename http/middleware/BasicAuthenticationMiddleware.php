<?php

declare(strict_types=1);

namespace Vdlp\BasicAuthentication\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Exception\SuspiciousOperationException;
use Vdlp\BasicAuthentication\Models\Credential;
use Vdlp\BasicAuthentication\Models\ExcludedUrl;

final class BasicAuthenticationMiddleware
{
    private Session $session;
    private Translator $translator;

    public function __construct(Session $session, Translator $translator)
    {
        $this->session = $session;
        $this->translator = $translator;
    }

    /**
     * @return mixed
     *
     * @throws SuspiciousOperationException
     * @throws InvalidArgumentException
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->isIpAddressWhitelisted((string) $request->ip())) {
            return $next($request);
        }

        try {
            /** @var Credential $credential */
            $credential = Credential::query()
                ->where('hostname', $request->getHost())
                ->where('is_enabled', true)
                ->firstOrFail(['hostname', 'username', 'password', 'realm']);
        } catch (ModelNotFoundException $exception) {
            // @ignoreException
            return $next($request);
        }

        // Current URI excluded so authorisation is not required.
        if ($this->isUrlExcluded($request)) {
            return $next($request);
        }

        $sessionKey = str_slug(str_replace('.', '_', $credential->hostname) . '_basic_authentication');

        // Session is authorized.
        if ($this->session->has($sessionKey)) {
            return $next($request);
        }

        // Validate credentials.
        if ($request->getUser() === $credential->username && $request->getPassword() === $credential->password) {
            $this->session->put($sessionKey, $request->getUser());

            return $next($request);
        }

        return new Response(
            $this->translator->get('vdlp.basicauthentication::lang.output.unauthorized'),
            401,
            [
                'WWW-Authenticate' => sprintf('Basic realm="%s"', $credential->realm),
            ]
        );
    }

    /**
     * @throws SuspiciousOperationException
     */
    private function isUrlExcluded(Request $request): bool
    {
        /** @var array|mixed $parsedCurrentUrl */
        $parsedCurrentUrl = parse_url($request->getUri());

        if (!is_array($parsedCurrentUrl)) {
            return false;
        }

        /** @var ExcludedUrl[] $excludedUrls */
        $excludedUrls = ExcludedUrl::all();

        foreach ($excludedUrls as $excludedUrl) {
            /** @var array|mixed $parsedExcludedUrl */
            $parsedExcludedUrl = parse_url($excludedUrl->url);

            if (!is_array($parsedExcludedUrl)) {
                continue;
            }

            $host = $parsedCurrentUrl['host'] ?? '';

            if (
                array_key_exists('host', $parsedExcludedUrl)
                && $host !== $request->getHost()
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

    private function isIpAddressWhitelisted(string $ipAddress): bool
    {
        return in_array(
            $ipAddress,
            explode(',', (string) config('basicauthentication.whitelisted_ips', '')),
            true
        );
    }
}

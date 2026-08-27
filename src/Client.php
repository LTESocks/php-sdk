<?php

declare(strict_types=1);

namespace LTESocks;

use Closure;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;
use LTESocks\Resource\GeneralResource;
use LTESocks\Resource\PaymentsResource;
use LTESocks\Resource\PortsResource;
use LTESocks\Resource\UserResource;
use LTESocks\Support\FileDownload;
use LTESocks\Support\Paginator;
use Psr\Http\Message\ResponseInterface;
use SplFileObject;
use UnexpectedValueException;

final class Client
{
    public const VERSION = '1.0.0';
    public const USER_AGENT = 'ltesocks-php/' . self::VERSION;

    /** @var array<class-string, object> */
    private array $resources = [];

    public function __construct(
        private readonly ClientInterface $httpClient,
        private readonly Configuration $configuration,
        private readonly string $language = 'en',
    ) {}

    public static function builder(): ClientBuilder
    {
        return new ClientBuilder();
    }

    public static function withBearerToken(string $token, string $baseUri = 'https://api.ltesocks.io/v2'): self
    {
        return self::builder()->withBearerToken($token)->withBaseUri($baseUri)->build();
    }

    public static function anonymous(string $baseUri = 'https://api.ltesocks.io/v2'): self
    {
        return self::builder()->anonymous()->withBaseUri($baseUri)->build();
    }

    public function user(): UserResource
    {
        return $this->resource(UserResource::class);
    }

    public function ports(): PortsResource
    {
        return $this->resource(PortsResource::class);
    }

    public function payments(): PaymentsResource
    {
        return $this->resource(PaymentsResource::class);
    }

    public function general(): GeneralResource
    {
        return $this->resource(GeneralResource::class);
    }

    /**
     * @param Closure(int, int): object $pageFetcher Receives page and page size.
     * @return Paginator<mixed>
     */
    public function paginate(Closure $pageFetcher, int $pageSize = 100, int $startPage = 1): Paginator
    {
        return new Paginator($pageFetcher, $pageSize, $startPage);
    }

    public function downloadPortVpn(string $portId): FileDownload
    {
        $file = $this->ports()->downloadVpn($portId);

        if (!$file instanceof SplFileObject) {
            throw new UnexpectedValueException('The VPN endpoint did not return a ZIP archive.');
        }

        return new FileDownload($file, \sprintf('ltesocks-port-%s-vpn.zip', $portId), 'application/zip');
    }

    /**
     * Escape hatch for endpoints added before the next SDK release.
     *
     * @param array<string, scalar|list<scalar>|null> $query
     * @param array<string, string> $headers
     * @param array<string, mixed>|null $json
     */
    public function raw(
        string $method,
        string $path,
        array $query = [],
        ?array $json = null,
        array $headers = [],
    ): ResponseInterface {
        $uri = rtrim($this->configuration->getHost(), '/') . '/' . ltrim($path, '/');
        $filteredQuery = array_filter($query, static fn(mixed $value): bool => null !== $value);

        if ([] !== $filteredQuery) {
            $uri .= '?' . http_build_query($filteredQuery, '', '&', PHP_QUERY_RFC3986);
        }

        $headers += [
            'Accept' => 'application/json',
            'Accept-Language' => $this->language,
            'User-Agent' => self::USER_AGENT,
        ];

        $authorization = null;
        if ('' !== $this->configuration->getAccessToken()) {
            $authorization = 'Bearer ' . $this->configuration->getAccessToken();
        }
        if (null !== $authorization) {
            $headers['Authorization'] = $authorization;
        }

        $body = null;
        if (null !== $json) {
            $headers['Content-Type'] = 'application/json';
            $body = json_encode($json, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES);
        }

        return $this->httpClient->send(new Request(strtoupper($method), $uri, $headers, $body), [
            'http_errors' => true,
        ]);
    }

    /** @return array{baseUri: string, language: string, resources: list<string>} */
    public function __debugInfo(): array
    {
        return [
            'baseUri' => $this->configuration->getHost(),
            'language' => $this->language,
            'resources' => array_keys($this->resources),
        ];
    }

    /**
     * @template T of object
     * @param class-string<T> $class
     * @return T
     */
    private function resource(string $class): object
    {
        /** @var T */
        return $this->resources[$class] ??= new $class($this->httpClient, $this->configuration);
    }
}

<?php

declare(strict_types=1);

namespace LTESocks;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use InvalidArgumentException;
use LTESocks\Support\IdempotencyClient;
use Psr\Http\Message\RequestInterface;

final class ClientBuilder
{
    private const DEFAULT_BASE_URI = 'https://api.ltesocks.io/v2';

    private ?string $bearerToken = null;
    private string $baseUri = self::DEFAULT_BASE_URI;
    private string $language = 'en';
    private float $timeout = 15.0;
    private float $connectTimeout = 5.0;
    private ?ClientInterface $httpClient = null;
    private bool $idempotency = true;

    public function withBearerToken(string $token): self
    {
        if ('' === trim($token)) {
            throw new InvalidArgumentException('The bearer token must not be empty.');
        }

        $clone = clone $this;
        $clone->bearerToken = $token;

        return $clone;
    }

    public function anonymous(): self
    {
        $clone = clone $this;
        $clone->bearerToken = null;

        return $clone;
    }

    public function withBaseUri(string $baseUri): self
    {
        $baseUri = rtrim(trim($baseUri), '/');
        $parts = parse_url($baseUri);

        if (
            false === $parts
            || !isset($parts['scheme'], $parts['host'])
            || !\in_array(strtolower($parts['scheme']), ['http', 'https'], true)
            || isset($parts['query'], $parts['fragment'])
        ) {
            throw new InvalidArgumentException('The base URI must be an absolute HTTP(S) URI without query or fragment.');
        }

        $clone = clone $this;
        $clone->baseUri = $baseUri;

        return $clone;
    }

    public function withLanguage(string $language): self
    {
        if ('' === trim($language) || 1 === preg_match('/[\r\n]/', $language)) {
            throw new InvalidArgumentException('The language header must be a non-empty single line.');
        }

        $clone = clone $this;
        $clone->language = $language;

        return $clone;
    }

    public function withTimeout(float $timeout, ?float $connectTimeout = null): self
    {
        if ($timeout <= 0 || (null !== $connectTimeout && $connectTimeout <= 0)) {
            throw new InvalidArgumentException('Timeout values must be greater than zero.');
        }

        $clone = clone $this;
        $clone->timeout = $timeout;
        $clone->connectTimeout = $connectTimeout ?? min(5.0, $timeout);

        return $clone;
    }

    public function withHttpClient(ClientInterface $httpClient): self
    {
        $clone = clone $this;
        $clone->httpClient = $httpClient;

        return $clone;
    }

    public function withIdempotency(bool $enabled = true): self
    {
        $clone = clone $this;
        $clone->idempotency = $enabled;

        return $clone;
    }

    public function build(): Client
    {
        $configuration = new Configuration()
            ->setHost($this->baseUri)
            ->setUserAgent(Client::USER_AGENT);

        if (null !== $this->bearerToken) {
            $configuration->setAccessToken($this->bearerToken);
        }

        $defaultHeaders = [
            'Accept-Language' => $this->language,
            'User-Agent' => Client::USER_AGENT,
        ];
        if (null !== $this->bearerToken) {
            $defaultHeaders['Authorization'] = 'Bearer ' . $this->bearerToken;
        }

        $httpClient = new IdempotencyClient(
            $this->httpClient ?? $this->createDefaultHttpClient(),
            (string) (parse_url($this->baseUri, PHP_URL_PATH) ?? ''),
            $this->idempotency,
            $defaultHeaders,
        );

        return new Client(
            $httpClient,
            $configuration,
            $this->language,
        );
    }

    private function createDefaultHttpClient(): ClientInterface
    {
        $language = $this->language;
        $stack = HandlerStack::create();
        $stack->push(Middleware::mapRequest(
            static fn(RequestInterface $request): RequestInterface => $request->withHeader('Accept-Language', $language),
        ));

        return new GuzzleClient([
            'handler' => $stack,
            'timeout' => $this->timeout,
            'connect_timeout' => $this->connectTimeout,
            'http_errors' => true,
        ]);
    }
}

<?php

declare(strict_types=1);

namespace LTESocks\Tests\Unit;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use LTESocks\ApiException;
use LTESocks\Client;
use LTESocks\Exception\ErrorKind;
use PHPUnit\Framework\TestCase;

final class ClientTest extends TestCase
{
    public function testBearerAuthenticationLanguageAndDefaultEndpoint(): void
    {
        $history = [];
        $mock = new MockHandler([new Response(200, [], '{"login":"demo"}')]);
        $stack = HandlerStack::create($mock);
        $stack->push(Middleware::history($history));
        $client = Client::builder()
            ->withBearerToken('account-token')
            ->withLanguage('ru')
            ->withHttpClient(new GuzzleClient(['handler' => $stack]))
            ->build();

        self::assertSame('demo', $client->user()->get()->getLogin());
        $request = $history[0]['request'];
        self::assertSame('https://api.ltesocks.io/v2/user', (string) $request->getUri());
        self::assertSame('Bearer account-token', $request->getHeaderLine('Authorization'));
        self::assertSame('ru', $request->getHeaderLine('Accept-Language'));
    }

    public function testErrorsExposeResetTimingAndRawPayload(): void
    {
        $mock = new MockHandler([
            new Response(500, [
                'Retry-After' => '42',
                'Retry-At' => '2026-08-27T12:00:00Z',
                'X-Request-ID' => 'request-123',
            ], '{"error":"Reset is cooling down"}'),
        ]);
        $client = Client::builder()
            ->withBearerToken('token')
            ->withHttpClient(new GuzzleClient(['handler' => HandlerStack::create($mock)]))
            ->build();

        try {
            $client->ports()->reset('10000');
            self::fail('Expected ApiException.');
        } catch (ApiException $error) {
            self::assertSame(ErrorKind::Server, $error->getErrorKind());
            self::assertSame('Reset is cooling down', $error->getDetail());
            self::assertSame(42, $error->getRetryAfter());
            self::assertSame('2026-08-27T12:00:00Z', $error->getRetryAt());
            self::assertSame('request-123', $error->getRequestId());
        }
    }

    public function testTransportRetryReusesOneKey(): void
    {
        $history = [];
        $mock = new MockHandler([
            new ConnectException('connection reset', new Request('POST', '/ports/10000/reset')),
            new Response(200, ['ETag' => '"port-v2"', 'Idempotency-Replayed' => 'true'], '{"port":"10000"}'),
        ]);
        $stack = HandlerStack::create($mock);
        $stack->push(Middleware::history($history));
        $client = Client::builder()
            ->withBearerToken('token')
            ->withHttpClient(new GuzzleClient(['handler' => $stack]))
            ->build();

        $response = $client->ports()->resetWithResponse('10000');

        self::assertCount(2, $history);
        $key = $history[0]['request']->getHeaderLine('Idempotency-Key');
        self::assertMatchesRegularExpression('/^[0-9a-f-]{36}$/', $key);
        self::assertSame($key, $history[1]['request']->getHeaderLine('Idempotency-Key'));
        self::assertSame('"port-v2"', $response->etag());
        self::assertTrue($response->idempotencyReplayed());
    }

    public function testHttpErrorsAreNotRetried(): void
    {
        $history = [];
        $mock = new MockHandler([new Response(503, [], '{"error":"Unavailable"}')]);
        $stack = HandlerStack::create($mock);
        $stack->push(Middleware::history($history));
        $client = Client::builder()
            ->withBearerToken('token')
            ->withHttpClient(new GuzzleClient(['handler' => $stack]))
            ->build();

        try {
            $client->ports()->reset('10000');
            self::fail('Expected ApiException.');
        } catch (ApiException $error) {
            self::assertSame(ErrorKind::Server, $error->getErrorKind());
        }
        self::assertCount(1, $history);
    }

    public function testRawEscapeHatchAndVpnDownload(): void
    {
        $mock = new MockHandler([
            new Response(200, [], '{"ok":true}'),
            new Response(200, [
                'Content-Type' => 'application/zip',
                'Content-Disposition' => 'attachment; filename="vpn.zip"',
            ], "PK\x03\x04example"),
        ]);
        $client = Client::builder()
            ->withBearerToken('token')
            ->withHttpClient(new GuzzleClient(['handler' => HandlerStack::create($mock)]))
            ->build();

        self::assertSame(200, $client->raw('GET', '/future', ['page' => 2])->getStatusCode());
        $download = $client->downloadPortVpn('10000');
        self::assertSame('application/zip', $download->contentType);
        self::assertSame("PK\x03\x04example", $download->contents());
    }
}

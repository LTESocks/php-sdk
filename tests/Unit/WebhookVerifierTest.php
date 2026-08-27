<?php

declare(strict_types=1);

namespace LTESocks\Tests\Unit;

use LTESocks\Webhook\InvalidSignatureException;
use LTESocks\Webhook\WebhookVerifier;
use PHPUnit\Framework\TestCase;

final class WebhookVerifierTest extends TestCase
{
    public function testExactBodySignatureAndJson(): void
    {
        $body = '{"id":"evt-1","type":"port.ip_changed"}';
        $signature = base64_encode(hash_hmac('sha256', $body, 'secret', true));

        self::assertTrue(WebhookVerifier::verify($body, $signature, 'secret'));
        self::assertFalse(WebhookVerifier::verify($body . ' ', $signature, 'secret'));
        self::assertSame('evt-1', WebhookVerifier::decodeVerifiedJson($body, $signature, 'secret')['id']);
    }

    public function testInvalidSignatureIsRejected(): void
    {
        $this->expectException(InvalidSignatureException::class);
        WebhookVerifier::verifyOrFail('{}', base64_encode(str_repeat('0', 32)), 'secret');
    }
}

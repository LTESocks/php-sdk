<?php

declare(strict_types=1);

namespace LTESocks\Webhook;

use JsonException;
use UnexpectedValueException;

final class WebhookVerifier
{
    public const SIGNATURE_HEADER = 'X-Signature';

    /** Verify Base64(HMAC-SHA256(secret, raw request body)). */
    public static function verify(string $rawBody, string $signature, string $secret): bool
    {
        if ('' === $signature || '' === $secret) {
            return false;
        }

        $received = base64_decode(trim($signature), true);
        if (false === $received) {
            return false;
        }

        return hash_equals(hash_hmac('sha256', $rawBody, $secret, true), $received);
    }

    public static function verifyOrFail(string $rawBody, string $signature, string $secret): void
    {
        if (!self::verify($rawBody, $signature, $secret)) {
            throw new InvalidSignatureException('The LTESocks webhook signature is invalid.');
        }
    }

    /** @return array<string, mixed> */
    public static function decodeVerifiedJson(string $rawBody, string $signature, string $secret): array
    {
        self::verifyOrFail($rawBody, $signature, $secret);

        try {
            $payload = json_decode($rawBody, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            throw new UnexpectedValueException('The verified webhook body is not valid JSON.', previous: $exception);
        }

        if (!\is_array($payload) || array_is_list($payload)) {
            throw new UnexpectedValueException('The verified webhook payload must be a JSON object.');
        }

        $object = [];
        foreach ($payload as $key => $value) {
            if (!\is_string($key)) {
                throw new UnexpectedValueException('The verified webhook payload must be a JSON object.');
            }
            $object[$key] = $value;
        }

        return $object;
    }
}

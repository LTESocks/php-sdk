<?php

declare(strict_types=1);

namespace LTESocks\Support;

use Psr\Http\Message\RequestInterface;

/** Generated from openapi/openapi.yaml; do not edit manually. */
final class IdempotencyPolicy
{
    private const ROUTES = [
        ['POST', '#^/user/preferences$#D'],
        ['POST', '#^/ports/order$#D'],
        ['POST', '#^/ports/[^/]+/extend$#D'],
        ['POST', '#^/ports/[^/]+/plan$#D'],
        ['POST', '#^/ports/[^/]+/tags$#D'],
        ['POST', '#^/ports/[^/]+/autorenew$#D'],
        ['POST', '#^/ports/[^/]+/signature$#D'],
        ['POST', '#^/ports/[^/]+/credentials$#D'],
        ['POST', '#^/ports/[^/]+/autoreset$#D'],
        ['POST', '#^/ports/[^/]+/reset$#D'],
    ];

    public static function supports(RequestInterface $request, string $basePath): bool
    {
        $path = $request->getUri()->getPath();
        if ('' !== $basePath && str_starts_with($path, $basePath)) {
            $path = substr($path, \strlen($basePath));
        }
        $path = '/' . ltrim($path, '/');
        foreach (self::ROUTES as [$method, $pattern]) {
            if ($method === strtoupper($request->getMethod()) && 1 === preg_match($pattern, $path)) {
                return true;
            }
        }

        return false;
    }
}

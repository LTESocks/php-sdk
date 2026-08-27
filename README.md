# LTESocks PHP SDK

[![CI](https://github.com/LTESocks/php-sdk/actions/workflows/ci.yml/badge.svg)](https://github.com/LTESocks/php-sdk/actions/workflows/ci.yml)
[![PHP](https://img.shields.io/badge/PHP-%3E%3D8.3-777BB4?logo=php&logoColor=white)](composer.json)
[![PHPStan](https://img.shields.io/badge/PHPStan-max-4F5B93)](phpstan.neon.dist)
[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)

The official PHP client for the [LTESocks Public API v2](https://docs.ltesocks.io/). It provides generated DTOs and resource methods for account preferences, mobile proxy ports, payments, plans, servers, and network signatures.

> Package publication has not started yet. The repository is ready, but `ltesocks/php-sdk` is intentionally not available on Packagist until the first release is approved.

## Installation for development

```bash
git clone https://github.com/LTESocks/php-sdk.git
cd php-sdk
composer install
```

After the first Packagist release, installation will be:

```bash
composer require ltesocks/php-sdk
```

## Quick start

```php
<?php

use LTESocks\Client;

require __DIR__ . '/vendor/autoload.php';

$client = Client::withBearerToken((string) getenv('LTESOCKS_API_TOKEN'));

$user = $client->user()->get();
$plans = $client->general()->listPlans();
$ports = $client->ports()->list();

echo $user->getLogin();
```

The default endpoint is `https://api.ltesocks.io/v2`. Configure custom transports and deployments through the immutable builder:

```php
<?php

$client = Client::builder()
    ->withBearerToken($token)
    ->withBaseUri('https://api.example.test/v2')
    ->withLanguage('en')
    ->withTimeout(30.0, 5.0)
    ->withHttpClient($psr18CompatibleGuzzleClient)
    ->build();
```

## Resources

| Resource | Purpose |
| --- | --- |
| `$client->user()` | Read the account and update preferences |
| `$client->ports()` | List, filter, order, update, reset, delete, and download VPN archives |
| `$client->payments()` | List/filter history and access reserved payment operations |
| `$client->general()` | List plans, servers, and signatures |

Every operation includes a `methodWithResponse()` variant that returns status, headers, ETag, and idempotency replay metadata. Generated method and DTO details are in [`docs/Api`](docs/Api) and [`docs/Model`](docs/Model).

## Typed request DTOs

```php
<?php

use LTESocks\Dto\OrderPortsRequest;

$port = $client->ports()->order(new OrderPortsRequest([
    'plan' => 'plan-id',
]));
```

## Idempotency and retries

The SDK creates a UUID for each supported mutation. It makes at most three attempts with the same key, and only retries transport failures that have no HTTP response. HTTP error responses are not retried automatically.

```php
<?php

$response = $client->ports()->resetWithResponse('10000');
var_dump($response->idempotencyReplayed());
```

Pass the generated method's `$idempotencyKey` argument to resume a logical request, or disable automatic keys with `withIdempotency(false)`. Read [idempotency, errors, and reset timing](docs/Guides/IdempotencyErrorsAndReset.md).

## Errors

```php
<?php

use LTESocks\ApiException;

try {
    $client->ports()->reset('10000');
} catch (ApiException $error) {
    echo $error->getStatusCode();
    echo $error->getErrorKind()->value;
    echo $error->getRetryAt() ?? '';
}
```

`ApiException` retains headers, response payload, retry metadata, and the idempotency key. `$client->raw()` is available for endpoints added before the next generated version.

## VPN archives

```php
<?php

$archive = $client->downloadPortVpn('10000');
$archive->saveTo(__DIR__ . '/ltesocks-vpn.zip');
```

## Webhooks

Verify exact raw bytes before JSON parsing. LTESocks sends `Base64(HMAC-SHA256(webhook_secret, raw_body))` in `X-Signature`.

```php
<?php

use LTESocks\Webhook\WebhookVerifier;

$event = WebhookVerifier::decodeVerifiedJson($rawBody, $signature, $webhookSecret);
```

See [webhook verification](docs/Guides/Webhooks.md).

## Development

```bash
composer install
./scripts/check-generated.sh
composer validate --strict
composer quality
composer audit
```

Generation uses OpenAPI Generator `v7.23.0` in Docker and the pinned [`openapi/openapi.yaml`](openapi/openapi.yaml). Run `php scripts/sync-openapi.php ../../site/docs/openapi.yaml` and regenerate after canonical changes.

## Links

- [Documentation](https://docs.ltesocks.io/)
- [API reference](https://docs.ltesocks.io/api-reference/)
- [OpenAPI YAML](https://docs.ltesocks.io/openapi.yaml)
- [JavaScript SDK](https://github.com/LTESocks/javascript-sdk)
- [Python SDK](https://github.com/LTESocks/python-sdk)
- [Security policy](SECURITY.md)
- [Contributing](CONTRIBUTING.md)

Licensed under the [MIT License](LICENSE).

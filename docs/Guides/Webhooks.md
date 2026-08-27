# Webhook verification

`X-Signature` contains `Base64(HMAC-SHA256(webhook_secret, raw_request_body))`. Verify the exact body before decoding JSON:

```php
<?php

$event = WebhookVerifier::decodeVerifiedJson($rawBody, $signature, $secret);
```

Store the event `id` before side effects and accept duplicates without repeating the action. Under the default delivery policy, an event can be delivered four times: the initial call plus three retries at 10-second intervals, with 5-second network timeouts.

See the [webhook contract](https://docs.ltesocks.io/webhooks/).

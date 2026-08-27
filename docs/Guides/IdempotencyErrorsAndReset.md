# Idempotency, errors, and port reset timing

The client automatically adds a UUID to the ten mutations that accept `Idempotency-Key`. It retries only transport failures without an HTTP response, for at most three total attempts. HTTP errors are not retried.

Pass the generated method's `$idempotencyKey` argument when a logical request must continue across process restarts.

## Reset timing

- HTTP `200` acknowledges a reset; it does not prove the new IP is ready.
- The minimum manual-reset cooldown is 60 seconds, and a pool can require longer.
- Respect `ApiException::getRetryAfter()` and `getRetryAt()`. If both exist, wait until the later deadline.
- Prefer `port.ip_changed`; otherwise poll `ports()->get()` with bounded backoff and compare the IP.
- Use an automatic reset interval of `0` to disable it or at least `180` seconds for supported scheduling. Values `1..179` are below the scheduler threshold.

See [Port reset and readiness](https://docs.ltesocks.io/guides/port-reset-and-readiness/).

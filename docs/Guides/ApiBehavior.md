# API behavior

- Filtered ports, logs, and payments use request DTOs with `page` and `pageSize`; the maximum page size is 100.
- Default service limits are 60 GET requests/minute and 10 mutation requests/minute. Deployments can override them; handle `429` explicitly.
- `payments()->listCurrencies()` and `payments()->request()` cover reserved operations still marked under development.
- Prefer `ports()->delete()` and `ports()->downloadVpn()`; the `*Compat()` methods represent POST compatibility routes.
- Use the `Port::getPort()` value in port routes. A reset token only identifies the token lookup endpoint.

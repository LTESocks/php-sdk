# Publishing checklist

The initial repository commit is not a release and must not publish to Packagist.

For an approved release, synchronize and regenerate OpenAPI, update package/client versions and `CHANGELOG.md`, run `composer quality` plus generated checks, then tag the reviewed `main` commit as `vX.Y.Z`. Packagist publication should be configured only after that approval.

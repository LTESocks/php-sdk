# Contributing

1. Install PHP 8.3 or newer, Composer, and Docker.
2. Run `composer install`.
3. Make handwritten changes outside generated `src/Dto` and `src/Resource` files.
4. Run `make quality` and `make generate-check` before opening a pull request.

API changes begin in the canonical LTESocks OpenAPI document. Synchronize
the schema, regenerate the client, and review the complete generated diff.

#!/usr/bin/env bash
set -euo pipefail

SDK_ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
GENERATOR_IMAGE="openapitools/openapi-generator-cli:v7.23.0"
GENERATOR_SPEC="${SDK_ROOT}/openapi/generator-openapi.yaml"

cleanup() {
  rm -f "${GENERATOR_SPEC}"
}
trap cleanup EXIT

php "${SDK_ROOT}/scripts/prepare-openapi.php"

# Remove only generator-owned trees so removed contract operations cannot leave stale classes.
rm -rf \
  "${SDK_ROOT}/src/Dto" \
  "${SDK_ROOT}/src/Resource" \
  "${SDK_ROOT}/docs/Api" \
  "${SDK_ROOT}/docs/Model" \
  "${SDK_ROOT}/.openapi-generator"

docker run --rm \
  --user "$(id -u):$(id -g)" \
  --volume "${SDK_ROOT}:/local" \
  "${GENERATOR_IMAGE}" generate \
  --input-spec /local/openapi/generator-openapi.yaml \
  --generator-name php \
  --output /local \
  --config /local/openapi/generator.yaml \
  --api-name-suffix Resource \
  --global-property apiTests=false,modelTests=false,apiDocs=true,modelDocs=true

# The stock Guzzle template returns documented 4xx bodies as model unions when
# http_errors is disabled by an injected client. Keep one predictable SDK error
# contract regardless of the consumer's Guzzle defaults.
find "${SDK_ROOT}/src/Resource" -type f -name '*Resource.php' -exec \
  perl -0pi -e 's/\$options = \[\];/\$options = [RequestOptions::HTTP_ERRORS => true];/g' {} +

# Let the client-wide language header apply unless a call explicitly overrides
# it. The generated request builders already omit the header for null values.
find "${SDK_ROOT}/src/Resource" -type f -name '*Resource.php' -exec \
  perl -0pi -e "s/\\\$acceptLanguage = 'en'/\\\$acceptLanguage = null/g" {} +

# Guzzle 8 removed Utils::jsonEncode(); route generated JSON serialization
# through the SDK compatibility helper while retaining Guzzle 7 support.
find "${SDK_ROOT}/src/Resource" -type f -name '*Resource.php' -exec \
  perl -0pi -e 's/\\GuzzleHttp\\Utils::jsonEncode/\\LTESocks\\Support\\Json::encode/g' {} +

php "${SDK_ROOT}/scripts/generate-idempotency-policy.php"
php "${SDK_ROOT}/scripts/add-response-methods.php"
php "${SDK_ROOT}/vendor/bin/php-cs-fixer" fix --allow-risky=yes --quiet \
  "${SDK_ROOT}/src/Support/IdempotencyPolicy.php"

# Preserve the generated request key on normalized SDK exceptions so callers
# can continue an application-level retry after the built-in attempts finish.
find "${SDK_ROOT}/src/Resource" -type f -name '*Resource.php' -exec \
  perl -0pi -e "s/(\\\$e->getResponse\(\) \? \(string\) \\\$e->getResponse\(\)->getBody\(\) : null)\n(\s*)\);/\\1,\n\\2\\\$e->getRequest()->getHeaderLine('Idempotency-Key') ?: null\n\\2);/g" {} +
find "${SDK_ROOT}/src/Resource" -type f -name '*Resource.php' -exec \
  perl -0pi -e "s/(null,\n\s*null)\n(\s*)\);/\\1,\n\\2\\\$e->getRequest()->getHeaderLine('Idempotency-Key') ?: null\n\\2);/g" {} +

# Avoid whitespace-only drift from upstream templates. Normalize every
# generator-owned PHP source, including root support files and DTOs.
find "${SDK_ROOT}/src/Resource" "${SDK_ROOT}/src/Dto" -type f -name '*.php' -exec \
  perl -0pi -e 's/[ \t]+$//mg; s/\n+\z/\n/' {} +
for generated_file in \
  Configuration.php \
  FormDataProcessor.php \
  HeaderSelector.php \
  ObjectSerializer.php \
  Support/IdempotencyPolicy.php; do
  perl -0pi -e 's/[ \t]+$//mg; s/\n+\z/\n/' "${SDK_ROOT}/src/${generated_file}"
done

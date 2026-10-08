<?php

declare(strict_types=1);

namespace LTESocks\Tests\Contract;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Yaml;

#[CoversNothing]
final class OpenApiCoverageTest extends TestCase
{
    /** @var array<string, class-string> */
    private const RESOURCE_BY_TAG = [
        'User' => \LTESocks\Resource\UserResource::class,
        'Ports' => \LTESocks\Resource\PortsResource::class,
        'Payments' => \LTESocks\Resource\PaymentsResource::class,
        'General' => \LTESocks\Resource\GeneralResource::class,
        'ResidentialSubusers' => \LTESocks\Resource\ResidentialSubusersResource::class,
    ];

    public function testEveryOperationHasAResourceAndResponseMethod(): void
    {
        $root = \dirname(__DIR__, 2);
        $openApi = Yaml::parseFile($root . '/openapi/openapi.yaml');
        $generator = Yaml::parseFile($root . '/openapi/generator.yaml');
        $mappings = $generator['operationIdNameMappings'] ?? [];
        self::assertIsArray($mappings);

        $covered = 0;
        foreach ($openApi['paths'] ?? [] as $path => $pathItem) {
            foreach (['get', 'post', 'put', 'patch', 'delete'] as $httpMethod) {
                if (!isset($pathItem[$httpMethod])) {
                    continue;
                }
                $operation = $pathItem[$httpMethod];
                $operationId = $operation['operationId'];
                $tag = $operation['tags'][0];
                self::assertArrayHasKey($operationId, $mappings, "Missing mapping for {$operationId}.");
                self::assertArrayHasKey($tag, self::RESOURCE_BY_TAG, "Missing resource for {$tag}.");
                self::assertTrue(method_exists(self::RESOURCE_BY_TAG[$tag], $mappings[$operationId]));
                self::assertTrue(method_exists(self::RESOURCE_BY_TAG[$tag], $mappings[$operationId] . 'WithResponse'));
                ++$covered;
            }
        }

        self::assertSame(36, $covered);
        self::assertCount(36, $mappings);
    }

    public function testVendoredSchemaMatchesItsManifest(): void
    {
        $root = \dirname(__DIR__, 2);
        $manifest = json_decode((string) file_get_contents($root . '/openapi/source.json'), true, 512, JSON_THROW_ON_ERROR);

        self::assertSame($manifest['sha256'], hash_file('sha256', $root . '/openapi/openapi.yaml'));
        self::assertSame(36, $manifest['operations']);
        self::assertSame(20, $manifest['schemas']);
    }
}

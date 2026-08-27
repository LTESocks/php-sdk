<?php

declare(strict_types=1);

use Symfony\Component\Yaml\Yaml;

require \dirname(__DIR__) . '/vendor/autoload.php';

$root = \dirname(__DIR__);
$document = Yaml::parseFile($root . '/openapi/openapi.yaml');

foreach ($document['paths'] as &$pathItem) {
    foreach (['get', 'post', 'put', 'patch', 'delete'] as $method) {
        if (!isset($pathItem[$method]) || !\is_array($pathItem[$method])) {
            continue;
        }

        $operation = &$pathItem[$method];
        $operationId = $operation['operationId'] ?? '';
        $responses = &$operation['responses'];

        foreach ($responses as $status => &$response) {
            if (!\is_array($response) || !isset($response['content']['*/*'])) {
                continue;
            }
            $media = $response['content']['*/*'];
            $response['content'] = str_starts_with((string) $status, '2')
                ? []
                : ['application/json' => $media];
        }
        unset($response);

        if (\in_array($operationId, ['getPortVpn', 'downloadPortVpnWithPost'], true)) {
            $responses['200'] = [
                'description' => 'ZIP archive',
                'content' => [
                    'application/octet-stream' => [
                        'schema' => ['type' => 'string', 'format' => 'binary'],
                    ],
                ],
            ];
            if (isset($responses['500'])) {
                $responses['500']['content'] = [
                    'application/json' => [
                        'schema' => ['$ref' => '#/components/schemas/Error'],
                    ],
                ];
            }
        }

        if ([] === array_filter(array_keys($responses), static fn(int|string $status): bool => str_starts_with((string) $status, '2'))) {
            $responses['204'] = ['description' => 'Reserved operation completed'];
        }

        unset($responses, $operation);
    }
}
unset($pathItem);

file_put_contents(
    $root . '/openapi/generator-openapi.yaml',
    Yaml::dump($document, 20, 2, Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK),
);

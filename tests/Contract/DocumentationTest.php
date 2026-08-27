<?php

declare(strict_types=1);

namespace LTESocks\Tests\Contract;

use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\TestCase;

#[CoversNothing]
final class DocumentationTest extends TestCase
{
    public function testDocumentationContainsOfficialLinksAndNoRegistryClaim(): void
    {
        $readme = (string) file_get_contents(\dirname(__DIR__, 2) . '/README.md');
        self::assertStringContainsString('https://docs.ltesocks.io/', $readme);
        self::assertStringContainsString('https://docs.ltesocks.io/api-reference/', $readme);
        self::assertStringContainsString('intentionally not available on Packagist', $readme);
    }

    public function testLocalMarkdownLinksResolve(): void
    {
        $root = \dirname(__DIR__, 2);
        $documents = [$root . '/README.md', ...glob($root . '/docs/Guides/*.md') ?: []];

        foreach ($documents as $document) {
            preg_match_all('/(?<!!)\[[^]]+]\(([^)\s]+)\)/', (string) file_get_contents($document), $matches);
            foreach ($matches[1] as $target) {
                if ('#' === $target[0] || preg_match('/^[a-z][a-z0-9+.-]*:/i', $target)) {
                    continue;
                }
                $local = explode('#', $target, 2)[0];
                self::assertFileExists(\dirname($document) . '/' . rawurldecode($local));
            }
        }
    }
}

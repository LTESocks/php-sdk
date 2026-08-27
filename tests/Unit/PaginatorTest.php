<?php

declare(strict_types=1);

namespace LTESocks\Tests\Unit;

use LTESocks\Support\Paginator;
use PHPUnit\Framework\TestCase;

final class PaginatorTest extends TestCase
{
    public function testItWalksPageMetadataLazily(): void
    {
        $calls = [];
        $paginator = new Paginator(function (int $page, int $pageSize) use (&$calls): object {
            $calls[] = $page;

            return new class ($page, $pageSize) {
                public function __construct(private readonly int $page, private readonly int $pageSize) {}
                public function getData(): array
                {
                    return 1 === $this->page ? [1, 2] : [3];
                }
                public function getPage(): int
                {
                    return $this->page;
                }
                public function getTotal(): int
                {
                    return 3;
                }
            };
        }, pageSize: 2);

        self::assertSame([], $calls);
        self::assertSame([1, 2, 3], iterator_to_array($paginator));
        self::assertSame([1, 2], $calls);
    }
}

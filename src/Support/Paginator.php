<?php

declare(strict_types=1);

namespace LTESocks\Support;

use Closure;
use InvalidArgumentException;
use IteratorAggregate;
use RuntimeException;
use Traversable;

/**
 * @template T
 * @implements IteratorAggregate<int, T>
 */
final class Paginator implements IteratorAggregate
{
    /** @param Closure(int, int): object $pageFetcher Receives page and page size. */
    public function __construct(
        private readonly Closure $pageFetcher,
        private readonly int $pageSize = 100,
        private readonly int $startPage = 1,
        private readonly int $maxPages = 10_000,
    ) {
        if ($pageSize < 1 || $pageSize > 100 || $startPage < 1 || $maxPages < 1) {
            throw new InvalidArgumentException('Page size must be 1..100; start page and max pages must be positive.');
        }
    }

    /** @return Traversable<int, T> */
    public function getIterator(): Traversable
    {
        $currentPage = $this->startPage;

        for ($iteration = 0; $iteration < $this->maxPages; ++$iteration) {
            $page = ($this->pageFetcher)($currentPage, $this->pageSize);

            if (!method_exists($page, 'getData') || !method_exists($page, 'getPage') || !method_exists($page, 'getTotal')) {
                throw new RuntimeException('A page object must expose getData(), getPage(), and getTotal().');
            }

            $data = $page->getData();
            if (!is_iterable($data) || $currentPage !== $page->getPage()) {
                throw new RuntimeException('The API returned invalid page data.');
            }

            $count = 0;
            foreach ($data as $result) {
                ++$count;
                /** @var T $result */
                yield $result;
            }

            $total = $page->getTotal();
            if (!\is_int($total)) {
                throw new RuntimeException('The API returned an invalid total count.');
            }
            if (0 === $count || $currentPage * $this->pageSize >= $total) {
                return;
            }
            ++$currentPage;
        }

        throw new RuntimeException('Pagination stopped after the configured maximum number of pages.');
    }
}

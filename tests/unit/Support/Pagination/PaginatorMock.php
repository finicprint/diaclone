<?php
declare(strict_types = 1);

namespace Test\Unit\Support\Pagination;

use Diaclone\Pagination\PaginatorInterface;

class PaginatorMock implements PaginatorInterface
{

    public function getCurrentPage(): int
    {
        return 1;
    }

    public function getLastPage(): int
    {
        return 10;
    }

    public function getTotal(): int
    {
        return 150;
    }

    public function getCount(): int
    {
        return 15;
    }

    public function getPerPage(): int
    {
        return 15;
    }

    public function getUrl($page): string
    {
        return '';
    }
}

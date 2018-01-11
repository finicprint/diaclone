<?php
declare(strict_types = 1);

namespace Test\Unit\Support\Pagination;

use Diaclone\Pagination\PaginatorInterface;

class PaginatorMock implements PaginatorInterface
{

    public function getCurrentPage()
    {
        return 1;
    }

    public function getLastPage()
    {
        return 10;
    }

    public function getTotal()
    {
        return 150;
    }

    public function getCount()
    {
        return 15;
    }

    public function getPerPage()
    {
        return 15;
    }

    public function getUrl($page)
    {
        return '';
    }
}

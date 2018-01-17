<?php

/*
 * This file is part of the Diaclone package.
 *
 * (c) Phil Sturgeon <me@philsturgeon.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Diaclone\Pagination;

/**
 * A common interface for paginators to use
 *
 * @author Marc Addeo <marcaddeo@gmail.com>
 */
interface PaginatorInterface
{
    /**
     * Get the current page.
     *
     * @return int
     */
    public function getCurrentPage(): int;

    /**
     * Get the last page.
     *
     * @return int
     */
    public function getLastPage(): int;

    /**
     * Get the total.
     *
     * @return int
     */
    public function getTotal(): int;

    /**
     * Get the count.
     *
     * @return int
     */
    public function getCount(): int;

    /**
     * Get the number per page.
     *
     * @return int
     */
    public function getPerPage(): int;

    /**
     * Get the url for the given page.
     *
     * @param int $page
     *
     * @return string
     */
    public function getUrl($page): string;
}

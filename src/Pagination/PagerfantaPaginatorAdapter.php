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

use Pagerfanta\Pagerfanta;

/**
 * A paginator adapter for pagerfanta/pagerfanta.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class PagerfantaPaginatorAdapter implements PaginatorInterface
{
    /**
     * The paginator instance.
     *
     * @var \Pagerfanta\Pagerfanta
     */
    protected $paginator;

    /**
     * The route generator.
     *
     * @var callable
     */
    protected $routeGenerator;

    /**
     * Create a new pagerfanta pagination adapter.
     *
     * @param \Pagerfanta\Pagerfanta $paginator
     * @param callable               $routeGenerator
     *
     * @return void
     */
    public function __construct(Pagerfanta $paginator, $routeGenerator)
    {
        $this->paginator = $paginator;
        $this->routeGenerator = $routeGenerator;
    }

    /**
     * Get the current page.
     *
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->paginator->getCurrentPage();
    }

    /**
     * Get the last page.
     *
     * @return int
     */
    public function getLastPage(): int
    {
        return $this->paginator->getNbPages();
    }

    /**
     * Get the total.
     *
     * @return int
     */
    public function getTotal(): int
    {
        return count($this->paginator);
    }

    /**
     * Get the count.
     *
     * @return int
     */
    public function getCount(): int
    {
        return count($this->paginator->getCurrentPageResults());
    }

    /**
     * Get the number per page.
     *
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->paginator->getMaxPerPage();
    }

    /**
     * Get the url for the given page.
     *
     * @param int $page
     *
     * @return string
     */
    public function getUrl($page): string
    {
        return call_user_func($this->routeGenerator, $page);
    }

    /**
     * Get the paginator instance.
     *
     * @return \Pagerfanta\Pagerfanta
     */
    public function getPaginator()
    {
        return $this->paginator;
    }

    /**
     * Get the the route generator.
     *
     * @return callable
     */
    public function getRouteGenerator()
    {
        return $this->routeGenerator;
    }
}

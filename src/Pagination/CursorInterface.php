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
 * A common interface for cursors to use.
 *
 * @author Isern Palaus <ipalaus@ipalaus.com>
 */
interface CursorInterface
{
    /**
     * Get the current cursor value.
     *
     * @return mixed
     */
    public function getCurrent();

    /**
     * Get the prev cursor value.
     *
     * @return mixed
     */
    public function getPrev();

    /**
     * Get the next cursor value.
     *
     * @return mixed
     */
    public function getNext();

    /**
     * Returns the total items in the current cursor.
     *
     * @return int
     */
    public function getCount();
}

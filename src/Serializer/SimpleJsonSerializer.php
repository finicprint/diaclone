<?php
declare(strict_types = 1);

namespace Diaclone\Serializer;

use Diaclone\Pagination\CursorInterface;
use Diaclone\Pagination\PaginatorInterface;
use stdClass;

class SimpleJsonSerializer extends SerializerAbstract
{
    public function collection($resourceKey, $data)
    {
        return json_encode(empty($resourceKey) ? (array)$data : [$resourceKey => $data], JSON_PRETTY_PRINT);
    }

    public function item($resourceKey, $data)
    {
        if (empty($data)) {
            $data = new stdClass();
        }

        if (! empty($resourceKey)) {
            $data = [$resourceKey => $data];
        }

        return json_encode($data, JSON_PRETTY_PRINT);
    }

    public function meta(array $meta)
    {
        if (empty($meta)) {
            return [];
        }

        return ['meta' => $meta];
    }

    public function paginator(PaginatorInterface $paginator)
    {
        $currentPage = (int)$paginator->getCurrentPage();
        $lastPage = (int)$paginator->getLastPage();

        $pagination = [
            'total'        => (int)$paginator->getTotal(),
            'count'        => (int)$paginator->getCount(),
            'per_page'     => (int)$paginator->getPerPage(),
            'current_page' => $currentPage,
            'total_pages'  => $lastPage,
        ];

        $pagination['links'] = [];

        if ($currentPage > 1) {
            $pagination['links']['previous'] = $paginator->getUrl($currentPage - 1);
        }

        if ($currentPage < $lastPage) {
            $pagination['links']['next'] = $paginator->getUrl($currentPage + 1);
        }

        return ['pagination' => $pagination];
    }

    public function cursor(CursorInterface $cursor)
    {
        $formatted = [
            'current' => $cursor->getCurrent(),
            'prev'    => $cursor->getPrev(),
            'next'    => $cursor->getNext(),
            'count'   => (int)$cursor->getCount(),
        ];

        return ['cursor' => $formatted];
    }
}

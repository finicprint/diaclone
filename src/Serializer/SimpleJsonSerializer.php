<?php
declare(strict_types = 1);

namespace Diaclone\Serializer;

use Diaclone\Pagination\CursorInterface;
use Diaclone\Pagination\PaginatorInterface;
use stdClass;

class SimpleJsonSerializer extends SerializerAbstract
{
    protected $jsonEncodingOptions = JSON_PRETTY_PRINT;

    public function collection($resourceKey, $data, array $metadata = [])
    {
        if (empty($resourceKey)) {
            $result = (array)$data;
        } else {
            $result = [$resourceKey => $data];
            if (!empty($metadata)) {
                $result['_metadata'] = $metadata;
            }
        }

        return json_encode($result, $this->jsonEncodingOptions);
    }

    public function item($resourceKey, $data)
    {
        if (empty($data)) {
            $data = new stdClass();
        }

        if (! empty($resourceKey)) {
            $data = [$resourceKey => $data];
        }

        return json_encode($data, $this->jsonEncodingOptions);
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
        $pagination = [
            'pageNumber' => (int)$paginator->getCurrentPage(),
            'perPage'    => (int)$paginator->getPerPage(),
            'pageCount'  => (int)$paginator->getLastPage(),
            'totalCount' => (int)$paginator->getTotal(),
        ];

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

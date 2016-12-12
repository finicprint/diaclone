<?php
declare(strict_types = 1);

namespace Diaclone\Resource;

use Diaclone\Transformer\AbstractTransformer;

class Collection extends AbstractResource
{
    public function transform(AbstractTransformer $transformer)
    {
        $items = $transformer->getPropertyValue($this->getData(), $this->getPropertyName());

        if (empty($items)) {
            return [];
        }

        $fieldMap = '*'; // todo: nested field map
        $response = [];

        foreach ($items as $item) {
            if ($transformedItem = $transformer->transform(new Item($item, '', $fieldMap))) {
                $response[] = $transformedItem;
            }
        }

        return $response;
    }

    public function untransform(AbstractTransformer $transformer)
    {
        $data = $this->getData();
        if (empty($data)) {
            return $data;
        }

        $response = [];
        foreach ($data as $item) {
            $response[] = $transformer->untransform(new Item($item, ''));
        }

        return $response;
    }
}
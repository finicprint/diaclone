<?php
declare(strict_types = 1);

namespace Diaclone\Resource;

use Diaclone\Transformer\AbstractTransformer;

class Collection extends AbstractResource
{
    public function transform(AbstractTransformer $transformer)
    {
        $value = $transformer->getPropertyValue($this->getData(), $this->getPropertyName());
        if (empty($value)) {
            return $value;
        }
        $propertyTransformerClass = $transformer->getPropertyTransformer($this->getPropertyName());
        $propertyTransformer = new $propertyTransformerClass();
        $fieldMap = '*'; // todo: nested field map
        $response = [];
        foreach ($value as $item) {
            $response[] = $propertyTransformer->transform(new Item($item, '', $fieldMap));
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
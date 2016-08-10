<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

class IntegerTransformer extends AbstractTransformer
{
    public function transform($data, $property, $fieldMap)
    {
        return (int)$this->getPropertyValue($data, $property);
    }
}
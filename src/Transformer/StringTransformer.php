<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

class StringTransformer extends AbstractTransformer
{
    public function transform($data, $property, $fieldMap)
    {
        return (string)$this->getPropertyValue($data, $property);
    }
}
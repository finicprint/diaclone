<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;

class IntegerTransformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        return (int)$this->getPropertyValue($resource->getData(), $resource->getPropertyName());
    }
}
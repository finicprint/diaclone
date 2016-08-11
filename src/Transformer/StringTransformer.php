<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;

class StringTransformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        return (string)$this->getPropertyValue($resource->getData(), $resource->getPropertyName());
    }
}
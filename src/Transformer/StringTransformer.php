<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;

class StringTransformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        return htmlentities((string)$this->getPropertyValueFromResource($resource));
    }

    public function untransform(ResourceInterface $resource)
    {
        return (string)$resource->getData();
    }
}
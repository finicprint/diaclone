<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;

class ArrayTransformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        return $this->getPropertyValueFromResource($resource);
    }

    public function untransform(ResourceInterface $resource)
    {
        return $resource;
    }
}
<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;

class RawStringTransformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        return (string)$this->getPropertyValueFromResource($resource);
    }

    public function untransform(ResourceInterface $resource)
    {
        return $resource->getData();
    }
}
<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;

class BooleanTransformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        return (bool)$this->getPropertyValueFromResource($resource);
    }

    public function untransform(ResourceInterface $resource)
    {
        return (bool)$resource->getData();
    }
}
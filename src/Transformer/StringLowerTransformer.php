<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;

class StringLowerTransformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        return strtolower((string)$this->getPropertyValueFromResource($resource));
    }

    public function untransform(ResourceInterface $resource)
    {
        return strtolower($resource->getData());
    }
}
<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;

class StringUpperTransformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        return strtoupper((string)$this->getPropertyValueFromResource($resource));
    }

    public function untransform(ResourceInterface $resource)
    {
        return strtoupper($resource->getData());
    }
}
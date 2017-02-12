<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;
use Exception;

class FloatTransformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        return (float)$this->getPropertyValueFromResource($resource);
    }

    public function untransform(ResourceInterface $resource)
    {
        try {
            return (float)$resource->getData();

        } catch (Exception $exception) {
            return $resource->getData();
        }
    }
}
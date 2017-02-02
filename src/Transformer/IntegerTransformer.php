<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;
use Exception;

class IntegerTransformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        return (int)$this->getPropertyValueFromResource($resource);
    }

    public function untransform(ResourceInterface $resource)
    {
        try {
            return (int)$resource->getData();

        } catch (Exception $exception) {
            return $resource->getData();
        }
    }
}
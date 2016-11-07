<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;

class BooleanTransformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        $value = $this->getPropertyValueFromResource($resource);

        return (bool)$value;
    }

    public function untransform(ResourceInterface $resource)
    {
        $value = strtolower((string)$resource->getData());

        if (in_array($value, ['yes', 'true', 'on', '1', 1])) {
            return true;
        }

        if (in_array($value, ['no', 'false', 'off', '0', 0])) {
            return false;
        }

        return $value;
        // throw new MalformedInputException($resource->getPropertyName(), 'must be boolean');
    }
}
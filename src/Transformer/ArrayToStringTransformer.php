<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;

class ArrayToStringTransformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        $data = $this->getPropertyValueFromResource($resource);

        if ($data === null || ! is_array($data)) {
            return null;
        }

        return json_encode($data);
    }

    public function untransform(ResourceInterface $resource)
    {
        $data = $resource->getData();

        if ($data === null || ! is_string($data)) {
            return null;
        }

        return json_decode($data, true);
    }
}

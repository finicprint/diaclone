<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;
use stdClass;

class JsonObjectTransformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        $value = $this->getPropertyValueFromResource($resource);

        return is_null($value) ? null : (empty($value) ? new stdClass() : $value);
    }

    public function untransform(ResourceInterface $resource)
    {
        return $resource->getData();
    }
}

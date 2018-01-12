<?php
declare(strict_types=1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;
use Ramsey\Uuid\Uuid;

class UuidTransformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        /** @var Uuid $value */
        $uuid = $this->getPropertyValueFromResource($resource);

        return (string) $uuid;
    }

    public function untransform(ResourceInterface $resource)
    {
        $uuid = $resource->getData();

        return $uuid ? Uuid::fromString($uuid) : null;
    }
}
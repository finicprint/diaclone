<?php
declare(strict_types=1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;

abstract class AbstractEnumTransformer extends AbstractTransformer
{
    public function untransform(ResourceInterface $resource)
    {
        if ($resource->getData() === null) {
            return null;
        }

        $data = $resource->getData();
        $propertyTransform = $this->getObjectClass();

        return $propertyTransform::byValue($data);
    }

    abstract public function getObjectClass(): string;
}
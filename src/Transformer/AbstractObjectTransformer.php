<?php
declare(strict_types=1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;

abstract class AbstractObjectTransformer extends AbstractTransformer
{
    abstract public function getObjectClass(): string;

    public function toArray(ResourceInterface $resource)
    {
        return $this->transform($resource);
    }

    public function toObject(ResourceInterface $resource)
    {
        return $this->untransform($resource);
    }
}

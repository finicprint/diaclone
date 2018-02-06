<?php
declare(strict_types=1);

namespace Test\Unit\Support\Transformers;

use Diaclone\Resource\ResourceInterface;
use Diaclone\Transformer\AbstractObjectTransformer;
use Test\Unit\Support\Entities\Password;

class PayloadToPasswordTransformer extends AbstractObjectTransformer
{
    public function getObjectClass(): string
    {
        return Password::class;
    }

    public function transform(ResourceInterface $resource)
    {
        $password = $this->getPropertyValueFromResource($resource);

        return $password->toString();
    }

    public function untransform(ResourceInterface $resource)
    {
        $value = $resource->getData();

        return Password::fromString($value);
    }
}
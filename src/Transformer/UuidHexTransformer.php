<?php
declare(strict_types=1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;
use Ramsey\Uuid\Uuid;

class UuidHexTransformer extends UuidTransformer
{
    public function transform(ResourceInterface $resource)
    {
        /** @var Uuid $value */
        $uuid = $this->getPropertyValueFromResource($resource);

        return $uuid ? $uuid->getHex() : null;
    }
}
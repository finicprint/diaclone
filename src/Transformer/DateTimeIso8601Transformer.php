<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Carbon\Carbon;
use Diaclone\Resource\ResourceInterface;

class DateTimeIso8601Transformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        return Carbon::instance($this->getPropertyValue($resource->getData(), $resource->getPropertyName()))->toIso8601String();
    }

    public function untransform(ResourceInterface $resource)
    {
        return new Carbon($resource->getData());
    }
}
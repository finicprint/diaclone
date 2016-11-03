<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Carbon\Carbon;
use Diaclone\Resource\ResourceInterface;

class DateTimeIso8601Transformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        $value = $this->getPropertyValueFromResource($resource);

        return $value ? Carbon::instance($value)->toIso8601String() : '';
    }

    public function untransform(ResourceInterface $resource)
    {
        $value = $resource->getData();

        return $value ? new Carbon($value) : null;
    }
}
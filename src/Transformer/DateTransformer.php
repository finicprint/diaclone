<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Carbon\Carbon;
use DateTime;
use Diaclone\Resource\ResourceInterface;

class DateTransformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        $value = $this->getPropertyValueFromResource($resource);

        if (is_string($value)) {
            return $value;
        }

        if ($value instanceof DateTime) {
            return Carbon::instance($value)->toDateString();
        }

        return '';
    }

    public function untransform(ResourceInterface $resource)
    {
        $value = $resource->getData();

        return $value ? (new Carbon($value))->toDateString() : null;
    }
}
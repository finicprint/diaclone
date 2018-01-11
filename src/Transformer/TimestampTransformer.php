<?php
declare(strict_types=1);

namespace Diaclone\Transformer;

use Carbon\Carbon;
use DateTime;
use Diaclone\Resource\ResourceInterface;

class TimestampTransformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        /** @var DateTime $value */
        $value = $this->getPropertyValueFromResource($resource);

        if (is_string($value)) {
           $value = new DateTime($value);
        }

        return $value->getTimestamp();
    }

    public function untransform(ResourceInterface $resource)
    {
        $value = $resource->getData();

        return $value ? (new DateTime())->setTimestamp((int) $value) : null;
    }
}
<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Carbon\Carbon;
use DateTime;
use Diaclone\Exception\TransformException;
use Diaclone\Resource\ResourceInterface;
use Exception;

class DateTimeIso8601Transformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        $value = $this->getPropertyValueFromResource($resource);
        if (empty($value)) {
            return '';
        }

        try {
            if ($carbon = self::parseCarbon($value)) {
                return $carbon->toIso8601String();
            }

            return '';
        } catch (Exception $e) {
            throw new TransformException('Failed to transform ' . $resource->getPropertyName() . ' because Carbon.');
        }
    }

    public static function parseCarbon($value)
    {
        if ($value instanceof Carbon) {
            return $value;
        }

        if ($value instanceof DateTime) {
            return Carbon::instance($value);
        }

        if (is_string($value)) {
            return new Carbon($value);
        }
    }

    public function untransform(ResourceInterface $resource)
    {
        $value = $resource->getData();

        if (empty($value)) {
            return null;
        }

        try {

            if (is_numeric($value)) {
                return Carbon::createFromTimestamp((int)$value);
            }

            return new Carbon($value);

        } catch (Exception $e) {
            return $value;
        }
    }
}

<?php
declare(strict_types=1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;

abstract class AbstractEnumTransformer extends AbstractTransformer
{
    public function getPropertyValue($data, $property)
    {
        if (empty($property)) {
            return $data->getValue();
        }

        // convert property to camelCase
        $getter = 'get' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $property)));
        if (method_exists($data, $getter)) {
            $enum = $data->$getter();

            return $enum->getValue();
        }

        return $data->$property->getValue() ?? null;
    }

    public function transform(ResourceInterface $resource)
    {
        return $this->getPropertyValueFromResource($resource);
    }

    public function untransform(ResourceInterface $resource)
    {
        if (!$data = $resource->getData()) {
            return null;
        }
        $propertyTransform = $this->getEnumClass();

        return $propertyTransform::byValue($data);
    }

    abstract public function getEnumClass(): string;
}
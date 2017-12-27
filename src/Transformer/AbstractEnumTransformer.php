<?php
declare(strict_types=1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;

abstract class AbstractEnumTransformer extends AbstractTransformer
{
    public function getPropertyValue($data, $property)
    {
        if (empty($property)) {
            return $data;
        }

        if (is_array($data)) {
            return $data[$property] ?? null;
        }

        // convert property to camelCase
        $getter = 'get' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $property)));
        if (method_exists($data, $getter)) {
            $enum = $data->$getter();
            return $enum->getValue();
        }

        return $data->$property ?? null;
    }
    
    public function transform(ResourceInterface $resource)
    {
        return $this->getPropertyValueFromResource($resource);
    }

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

<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Illuminate\Support\Collection;

abstract class AbstractTransformer
{
    public function transform($data, $property, $fieldMap): array
    {
        $value = $this->getPropertyValue($data, $property);
        if (empty($value)) {
            return $value;
        }
        $fieldMap = $fieldMap; // todo: nested field map
        if ($this->isCollection($value)) {
            $response = [];

            foreach ($value as $item) {
                $transformerClass = static::$propertyTransformers[$property];
                $response[] = (new $transformerClass)->transform($item, '', $fieldMap);
            }

            return $response;
        }

        return $this->_transform($value, $property, $fieldMap);
    }

    protected function getPropertyValue($data, $property)
    {
        if (empty($property)) {
            return $data;
        }

        if (is_array($data)) {
            return $data[$property];
        }

        $getter = 'get' . ucfirst(camel_case($property));
        if (method_exists($data, $getter)) {
            return $data->$getter();
        }

        return $data->$property;
    }

    protected function _transform($data, $property, $fieldMap): array
    {
        $includeAll = false;
        $response = [];
        if ($fieldMap === '*') {
            $includeAll = true;
            $fieldMap = array_keys(static::$mappedProperties);
        }
        foreach ($fieldMap as $property) {
            // todo: exception if value isn't in transformer or mapped
            $transformerClass = static::$propertyTransformers[$property];

            if ($includeAll) {
                $propertiesToTransform = '*';
            }
            $response[static::$mappedProperties[$property]] = (new $transformerClass)->transform($data, $property, $propertiesToTransform);
        }

        return $response;
    }

    protected function isCollection($value): bool
    {
        if ($value instanceof Collection) {
            return true;
        }

        return false;
    }
}
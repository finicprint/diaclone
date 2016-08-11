<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Resource\Item;
use Diaclone\Resource\ResourceInterface;

abstract class AbstractTransformer
{
    /**
     * The type of data that is being handled. The key is the system name of the property, the class name of the
     * Resource is the value. If not configured it is an Item
     *
     * $dataTypes = [
     *     'fullName' => Item::class
     *     'my_friends' => Collection::class,
     * ];
     */
    protected static $dataTypes = [];

    /**
     * Every valid property must have a property mapping. The key is the system name for the property or the property name of the
     * getter (for example 'fullName' would use the getter 'getFullName', even thought the 'fullName' property doesn't exist,
     * the value is the public name for the property
     *
     * $mappedProperties = [
     *     'age' => 'age,
     *     'full_name' => 'name',
     *     'my_friends' => 'friends',
     * ];
     */
    protected static $mappedProperties = [];

    /**
     * How the data should be transformed. The key is the system name of the property, the class name of the Transformer
     * is the value. If the property is not configured, it defaults to a StringTransformer
     *
     * $transformers = [
     *     'age' => IntegerTransformer::class,
     * ];
     */
    protected static $transformers = [];


    public function getDataType(string $property): string
    {
        return isset(static::$dataTypes[$property]) ? static::$dataTypes[$property] : Item::class;
    }

    public function getMappedProperties(): array
    {
        return static::$mappedProperties;
    }

    public function getPropertyTransformer(string $property): string
    {
        return isset(static::$transformers[$property]) ? static::$transformers[$property] : StringTransformer::class;
    }

    public function getPropertyValue($data, $property)
    {
        if (empty($property)) {
            return $data;
        }

        if (is_array($data)) {
            return $data[$property];
        }

        // convert property to camelCase
        $getter = 'get' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $property)));
        if (method_exists($data, $getter)) {
            return $data->$getter();
        }

        return $data->$property;
    }

    public function transform(ResourceInterface $resource)
    {
        return $resource->transform($this);
    }

    public function untransform(ResourceInterface $resource)
    {
        return $resource->untransform($this);
    }
}
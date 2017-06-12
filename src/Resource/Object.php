<?php
declare(strict_types = 1);

namespace Diaclone\Resource;

use Diaclone\Exception\MalformedInputException;
use Diaclone\Exception\TransformException;
use Diaclone\Exception\UnrecognizedInputException;
use Diaclone\Transformer\AbstractTransformer;
use Exception;

class Object extends Item
{
    public function untransform(AbstractTransformer $transformer)
    {
        if ($this->getData() === null) {
            return null;
        }

        $unrecognizedFields = [];
        $malformedFields = [];

        $className = $transformer->getObjectClass();
        $response = new $className();

        $mapping = array_flip($transformer->getMappedProperties());

        foreach ($this->getData() as $incomingProperty => $data) {
            if (empty($mapping[$incomingProperty])) {
                $unrecognizedFields[] = $incomingProperty;
                continue;
            }
            $property = $mapping[$incomingProperty];

            $propertyTransformerClass = $transformer->getPropertyTransformer($property);
            /** @var AbstractTransformer $propertyTransformer */
            $propertyTransformer = new $propertyTransformerClass();

            $dataTypeClass = $this->getDataType($propertyTransformer, $property);
            $dataType = new $dataTypeClass($data, $property);

            if ($propertyTransformer->allowUntransform()) {
                try {
                    $this->setPropertyValue($response, $property, $propertyTransformer->untransform($dataType));
                } catch (UnrecognizedInputException $e) {
                    throw $e;
                } catch (Exception $e) {
                    $malformedFields[] = $incomingProperty;
                }
            }
        }

        if (! empty($unrecognizedFields)) {
            throw new UnrecognizedInputException($unrecognizedFields, $transformer);
        }

        if (! empty($malformedFields)) {
            throw new MalformedInputException($malformedFields);
        }

        return $response;
    }

    protected function setPropertyValue($object, $property, $value)
    {
        // convert property to camelCase
        $setter = 'set' . str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $property)));
        if (method_exists($object, $setter)) {
            $object->$setter($value);

            return;
        }

        if (property_exists($object, $property)) {
            $object->$property = $value;

            return;
        }

        throw new TransformException(sprintf('You must either create a %s method in %s or add a public property', $setter, get_class($object), $property));
    }

    protected function getDataType($transformer, string $property): string
    {
        $rp = new \ReflectionProperty($transformer, 'dataTypes');
        $rp->setAccessible(true);
        $types = $rp->getValue($transformer);
        if (empty($types[$property])) {
            return Object::class;
        }
        if (Collection::class === $types[$property]) {
            return ObjectCollection::class;
        }

        return $types[$property];
    }
}

<?php
declare(strict_types = 1);

namespace Diaclone\Resource;

use Diaclone\Exception\MalformedInputException;
use Diaclone\Exception\UnrecognizedInputException;
use Diaclone\Transformer\AbstractTransformer;
use Exception;

class Item extends AbstractResource
{
    public function transform(AbstractTransformer $transformer)
    {
        $mappedProperties = $transformer->getMappedProperties();
        $response = [];

        if ($propertyName = $this->getPropertyName()) {
            $data = $transformer->getPropertyValue($this->getData(), $propertyName);
        } else {
            $data = $this->getData();
        }

        if (empty($data)) {
            return null;
        }

        if ($this->fieldMap->isWildcard()) {
            $includeAll = true;
            $fieldMap = array_keys($mappedProperties);
        } else {
            // TODO: include partials
            $includeAll = true;
            $fieldMap = $this->fieldMap->getPartials();
            if ($diff = array_diff($fieldMap, array_keys($mappedProperties))) {
                throw new UnrecognizedInputException($diff);
            }
        }

        foreach ($fieldMap as $property) {
            // todo: exception if value isn't mapped

            if ($includeAll) {
                $propertiesToTransform = '*';
            }

            $dataTypeClass = $transformer->getDataType($property);
            $dataType = new $dataTypeClass($data, $property, $propertiesToTransform);

            $propertyTransformerClass = $transformer->getPropertyTransformer($property);
            /** @var AbstractTransformer $propertyTransformer */
            $propertyTransformer = new $propertyTransformerClass();

            if ($propertyTransformer->allowTransform()) {
                $response[$mappedProperties[$property]] = $propertyTransformer->transform($dataType);
            }
        }

        return $response;
    }

    public function untransform(AbstractTransformer $transformer)
    {
        $unrecognizedFields = [];
        $malformedFields = [];
        $response = [];

        $mapping = array_flip($transformer->getMappedProperties());

        foreach ($this->getData() as $incomingProperty => $data) {
            if (empty($mapping[$incomingProperty])) {
                $unrecognizedFields[] = $incomingProperty;
                continue;
            }
            $property = $mapping[$incomingProperty];

            $dataTypeClass = $transformer->getDataType($property);
            $dataType = new $dataTypeClass($data, $property);

            $propertyTransformerClass = $transformer->getPropertyTransformer($property);
            /** @var AbstractTransformer $propertyTransformer */
            $propertyTransformer = new $propertyTransformerClass();

            if ($propertyTransformer->allowUntransform()) {
                try {
                    $response[$property] = $propertyTransformer->untransform($dataType);
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
}
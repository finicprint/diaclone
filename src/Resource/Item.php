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

        $fieldMap = $this->fieldMap->isWildcard()
            ? array_keys($mappedProperties)
            : $this->fieldMap->getFieldsList();

        // validate fields list
        if ($diff = array_diff($fieldMap, array_keys($mappedProperties))) {
            throw new UnrecognizedInputException($diff, $transformer);
        }

        foreach ($fieldMap as $property) {
            $dataTypeClass = $transformer->getDataType($property);
            /** @var Item|Collection $dataType */
            $dataType = new $dataTypeClass($data, $property, $this->fieldMap->getField($property));

            $transformerClasses = $transformer->getPropertyTransformers($property);
            if (! is_array($transformerClasses)) {
                $transformerClasses = [$transformerClasses];
            }

            foreach($transformerClasses as $transformerClass) {
                /** @var AbstractTransformer $propertyTransformer */
                $propertyTransformer = new $transformerClass();

                if (! $propertyTransformer->allowTransform($dataType)) {
                    // if any item in the chain doesn't allow transform, break
                    $dataType = null;
                    break;
                }

                $dataType = new $dataTypeClass($propertyTransformer->transform($dataType));
            }
            if ($dataType) {
                $response[$mappedProperties[$property]] = $dataType->getData();
            }
        }

        return $response;
    }

    public function untransform(AbstractTransformer $transformer)
    {
        $unrecognizedFields = [];
        $malformedFields = [];
        $response = [];

        if ($this->getData() === null) {
            return null;
        }

        $mapping = array_flip($transformer->getMappedProperties());

        foreach ($this->getData() as $incomingProperty => $data) {
            if (empty($mapping[$incomingProperty])) {
                $unrecognizedFields[] = $incomingProperty;
                continue;
            }
            $property = $mapping[$incomingProperty];

            $dataTypeClass = $transformer->getDataType($property);
            $dataType = new $dataTypeClass($data, $property);

            $transformerClasses = $transformer->getPropertyTransformers($property);
            if (! is_array($transformerClasses)) {
                $transformerClasses = [$transformerClasses];
            }

            // process from last to first in definition
            $transformerClasses = array_reverse($transformerClasses);

            foreach($transformerClasses as $transformerClass) {
                /** @var AbstractTransformer $propertyTransformer */
                $propertyTransformer = new $transformerClass();

                if (! $propertyTransformer->allowUntransform($dataType)) {
                    // if any item in the chain doesn't allow untransform, break
                    $dataType = null;
                    break;
                }

                try {
                    $dataType = new $dataTypeClass($propertyTransformer->untransform($dataType));
                } catch (UnrecognizedInputException $e) {
                    throw $e;
                } catch (Exception $e) {
                    $malformedFields[] = $incomingProperty;
                }
            }
            if ($dataType) {
                $response[$property] = $dataType->getData();
            }
        }

        if (! empty($unrecognizedFields)) {
            throw new UnrecognizedInputException($unrecognizedFields, $transformer);
        }

        if (! empty($malformedFields)) {
            throw new MalformedInputException($malformedFields, $transformer);
        }

        return $response;
    }
}
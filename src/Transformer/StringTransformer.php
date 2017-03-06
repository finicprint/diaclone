<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Exception\MalformedInputException;
use Diaclone\Exception\TransformException;
use Diaclone\Resource\ResourceInterface;
use Exception;

class StringTransformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        $value = $this->getPropertyValueFromResource($resource);

        try {
            return htmlentities((string)$value);

        } catch (Exception $exception) {
            throw new TransformException('Failed to transform ' . $resource->getPropertyName(), 0, $exception);
        }
    }

    public function untransform(ResourceInterface $resource)
    {
        try {
            return html_entity_decode((string)$resource->getData());

        } catch (Exception $exception) {
            throw new MalformedInputException([$resource->getPropertyName(), 'String expected']);
        }
    }
}
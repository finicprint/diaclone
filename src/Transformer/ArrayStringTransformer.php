<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Exception\MalformedInputException;
use Diaclone\Resource\ResourceInterface;
use Exception;

class ArrayStringTransformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        $data = $this->getPropertyValueFromResource($resource);

        if ($data === null || ! is_array($data)) {
            return null;
        }

        foreach ($data as &$value) {
            $value = htmlentities((string)$value);
        }

        return $data;
    }

    public function untransform(ResourceInterface $resource)
    {
        $data = $resource->getData();

        if ($data === null) {
            return null;
        }

        try {
            foreach ($data as &$value) {
                $value = html_entity_decode((string)$value);
            }

        } catch (Exception $exception) {
            throw new MalformedInputException([$value, 'String expected'], $this);
        }

        return $data;
    }
}

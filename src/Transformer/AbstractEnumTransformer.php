<?php
declare(strict_types=1);

namespace Diaclone\Transformer;

use Diaclone\Exception\TransformException;
use Diaclone\Resource\ResourceInterface;
use MabeEnum\Enum;

abstract class AbstractEnumTransformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        /** @var Enum $enum */
        $enum = $this->getPropertyValueFromResource($resource);

        return $enum->getValue();
    }

    public function untransform(ResourceInterface $resource)
    {
        if (!$data = $resource->getData()) {
            return null;
        }
        /** @var Enum $enumClass */
        $enumClass = $this->getEnumClass();
        if (!$enumClass::has($data)) {
            throw new TransformException(sprintf('"%s" is not a valid value in the enum %s', $data, $enumClass));
        }

        return $enumClass::byValue($data);
    }

    abstract public function getEnumClass(): string;
}
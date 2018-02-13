<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Exception\MalformedInputException;
use Diaclone\Exception\TransformException;
use Diaclone\Resource\ResourceInterface;
use Diaclone\Traits\EmojiTrait;
use Exception;

class StringTransformer extends AbstractTransformer
{
    use EmojiTrait;

    public function transform(ResourceInterface $resource)
    {
        $value = (string)$this->getPropertyValueFromResource($resource);

        try {
            $value = $this->convertToEmojis($value);

            return htmlentities($value);

        } catch (Exception $exception) {
            throw new TransformException('Failed to transform ' . $resource->getPropertyName(), 0, $exception);
        }
    }

    public function untransform(ResourceInterface $resource)
    {
        $value = (string)$resource->getData();

        try {
            $value = $this->convertFromEmojis($value);

            return html_entity_decode($value);

        } catch (Exception $exception) {
            throw new MalformedInputException([$resource->getPropertyName(), 'String expected']);
        }
    }
}

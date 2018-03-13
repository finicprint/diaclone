<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;
use Diaclone\Traits\EmojiTrait;

class EmojiCharactersTransformer extends AbstractTransformer
{
    use EmojiTrait;

    public function transform(ResourceInterface $resource)
    {
        $value = (string)$this->getPropertyValueFromResource($resource);

        return $this->convertToEmojis($value);
    }

    public function untransform(ResourceInterface $resource)
    {
        $value = (string)$resource->getData();

        return $this->convertFromEmojis($value);
    }
}


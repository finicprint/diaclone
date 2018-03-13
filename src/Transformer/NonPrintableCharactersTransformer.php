<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;
use Diaclone\Traits\EmojiTrait;

class NonPrintableCharactersTransformer extends AbstractTransformer
{
    use EmojiTrait;

    public function transform(ResourceInterface $resource)
    {
        $value = (string)$this->getPropertyValueFromResource($resource);

        return preg_replace('/[\x00-\x1F\x7F\xA0]/u', '', $value);
    }

    public function untransform(ResourceInterface $resource)
    {
        return (string)$resource->getData();
    }
}


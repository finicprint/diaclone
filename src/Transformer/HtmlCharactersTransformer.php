<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;
use Diaclone\Traits\EmojiTrait;

class HtmlCharactersTransformer extends AbstractTransformer
{
    use EmojiTrait;

    public function transform(ResourceInterface $resource)
    {
        $value = (string)$this->getPropertyValueFromResource($resource);

        return htmlentities($value);
    }

    public function untransform(ResourceInterface $resource)
    {
        $value = (string)$resource->getData();

        return html_entity_decode($value);
    }
}


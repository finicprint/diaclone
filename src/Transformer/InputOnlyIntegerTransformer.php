<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;

class InputOnlyIntegerTransformer extends IntegerTransformer
{
    public function allowTransform(ResourceInterface $resource): bool
    {
        return false;
    }
}
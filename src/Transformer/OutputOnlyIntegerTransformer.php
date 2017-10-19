<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;

class OutputOnlyIntegerTransformer extends IntegerTransformer
{
    public function allowUntransform(ResourceInterface $resource): bool
    {
        return false;
    }
}
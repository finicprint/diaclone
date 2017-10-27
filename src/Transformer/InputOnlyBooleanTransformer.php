<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;

class InputOnlyBooleanTransformer extends BooleanTransformer
{
    public function allowTransform(ResourceInterface $resource): bool
    {
        return false;
    }
}
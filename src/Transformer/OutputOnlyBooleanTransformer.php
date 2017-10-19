<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;

class OutputOnlyBooleanTransformer extends BooleanTransformer
{
    public function allowUntransform(ResourceInterface $resource): bool
    {
        return false;
    }
}
<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

class OutputOnlyBooleanTransformer extends BooleanTransformer
{
    public function allowUntransform()
    {
        return false;
    }
}
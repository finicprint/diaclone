<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

class OutputOnlyIntegerTransformer extends IntegerTransformer
{
    public function allowUntransform()
    {
        return false;
    }
}
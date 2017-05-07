<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

class OutputOnlyFloatTransformer extends FloatTransformer
{
    public function allowUntransform()
    {
        return false;
    }
}
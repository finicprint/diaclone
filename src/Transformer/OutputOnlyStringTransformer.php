<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

class OutputOnlyStringTransformer extends StringTransformer
{
    public function allowUntransform()
    {
        return false;
    }
}
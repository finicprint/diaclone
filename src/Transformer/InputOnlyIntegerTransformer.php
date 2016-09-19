<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

class InputOnlyIntegerTransformer extends IntegerTransformer
{
    public function allowTransform()
    {
        return false;
    }
}
<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

class InputOnlyStringTransformer extends StringTransformer
{
    public function allowTransform()
    {
        return false;
    }
}
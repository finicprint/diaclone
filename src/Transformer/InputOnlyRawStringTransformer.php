<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

class InputOnlyRawStringTransformer extends RawStringTransformer
{
    public function allowTransform()
    {
        return false;
    }
}
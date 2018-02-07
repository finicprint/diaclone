<?php
declare(strict_types=1);

namespace Test\Unit\Support\Transformers;

use Diaclone\Transformer\AbstractEnumTransformer;
use Test\Unit\Support\Entities\ColorType;

class ColorTypeTransformer extends AbstractEnumTransformer
{
    public function getEnumClass(): string
    {
        return ColorType::class;
    }
}
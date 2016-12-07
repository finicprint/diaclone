<?php
declare(strict_types = 1);

namespace Test\Unit\Support\Transformers;

use Diaclone\Transformer\AbstractTransformer;
use Diaclone\Transformer\StringTransformer;

class OccupationTransformer extends AbstractTransformer
{
    protected static $transformers = [
        'name' => StringTransformer::class,
    ];

    protected static $mappedProperties = [
        'name' => 'name',
    ];
}
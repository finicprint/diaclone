<?php
declare(strict_types = 1);

namespace Test\Unit\Support\Transformers;

use Diaclone\Resource\Collection;
use Diaclone\Transformer\AbstractTransformer;
use Diaclone\Transformer\IntegerTransformer;

class PersonArrayTransformer extends AbstractTransformer
{
    protected static $mappedProperties = [
        'name'       => 'name',
        'age'        => 'age',
        'pigLatin'   => 'pigLatin',
        'my_job'     => 'occupation',
        'my_friends' => 'friends',
    ];

    protected static $transformers = [
        'age'        => IntegerTransformer::class,
        'my_job'     => OccupationArrayTransformer::class,
        'my_friends' => PersonArrayTransformer::class,
        'pigLatin'   => PigLatinTransformer::class,
    ];

    protected static $dataTypes = [
        'my_friends' => Collection::class,
    ];
}
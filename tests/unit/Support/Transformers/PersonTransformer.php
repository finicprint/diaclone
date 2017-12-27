<?php
declare(strict_types = 1);

namespace Test\Unit\Support\Transformers;

use Diaclone\Resource\Collection;
use Diaclone\Transformer\AbstractObjectTransformer;
use Diaclone\Transformer\IntegerTransformer;
use Test\Unit\Support\Entities\Person;

class PersonTransformer extends AbstractObjectTransformer
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
        'my_job'     => OccupationTransformer::class,
        'my_friends' => PersonTransformer::class,
        'pigLatin'   => PigLatinTransformer::class,
    ];

    protected static $dataTypes = [
        'my_friends' => Collection::class,
    ];

    public function getObjectClass(): string
    {
        return Person::class;
    }
}

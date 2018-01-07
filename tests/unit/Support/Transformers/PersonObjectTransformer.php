<?php
declare(strict_types = 1);

namespace Test\Unit\Support\Transformers;

use Diaclone\Resource\ObjectCollection;
use Diaclone\Transformer\AbstractObjectTransformer;
use Diaclone\Transformer\IntegerTransformer;
use Test\Unit\Support\Entities\Person;

class PersonObjectTransformer extends AbstractObjectTransformer
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
        'my_job'     => OccupationObjectTransformer::class,
        'my_friends' => PersonObjectTransformer::class,
        'pigLatin'   => PigLatinTransformer::class,
    ];

    protected static $dataTypes = [
        'my_friends' => ObjectCollection::class,
    ];

    public function getObjectClass(): string
    {
        return Person::class;
    }
}
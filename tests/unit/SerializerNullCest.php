<?php
declare(strict_types = 1);

namespace Test\Unit;

use UnitTester;
use Diaclone\Serializer\SimpleJsonSerializer;
use Diaclone\TransformService;
use Test\Unit\Support\Entities\Person;
use Test\Unit\Support\Transformers\PersonTransformer;

class SerializerNullCest
{
    public function textSerializeNullToObject(UnitTester $I)
    {
        $person = [
            'name' => 'My name is Bill',
            'age'  => 42,
        ];

        $expected = json_encode([
            'name'       => 'My name is Bill',
            'age'        => 42,
            'pigLatin'   => 'Ymay amenay isyay Illbay',
            'occupation' => null,
            'friends'    => [],
        ], JSON_PRETTY_PRINT);

        $output = (new TransformService(new SimpleJsonSerializer()))->transform($person, new PersonTransformer());

        $I->assertSame($expected, $output);
    }


    public function testSerializerNull(UnitTester $I)
    {
        $output = (new TransformService(new SimpleJsonSerializer()))->transform([], new PersonTransformer(), 'person');

        $expected = json_encode([
            'person' => (object)[],
        ], JSON_PRETTY_PRINT);

        $I->assertSame($expected, $output);
    }

    public function testTransformationNullNoKey(UnitTester $I)
    {
        $output = (new TransformService(new SimpleJsonSerializer()))->transform(null, new PersonTransformer());

        $expected = '{}';

        $I->assertSame($expected, $output);
    }


    public function testTransformationNullChild(UnitTester $I)
    {
        $friends = [
            new Person('Paul', 'Real estate novelist'),
            new Person('John', 'Bartender'),
            [],
            null,
        ];

        $output = (new TransformService(new SimpleJsonSerializer()))->transform(new Person('Bill', 'Piano Man',
            $friends), new PersonTransformer(), 'person');

        $expected = json_encode([
            'person' => [
                'name'       => 'My name is Bill',
                'age'        => 42,
                'pigLatin'   => 'Ymay amenay isyay Illbay',
                'occupation' => [
                    'name'      => 'Piano Man',
                    'startDate' => '2017-01-01 10:10:10',
                ],
                'friends'    => [
                    [
                        'name'       => 'My name is Paul',
                        'age'        => 42,
                        'pigLatin'   => 'Ymay amenay isyay Aulpay',
                        'occupation' => [
                            'name'      => 'Real estate novelist',
                            'startDate' => '2017-01-01 10:10:10',
                        ],
                        'friends'    => [],
                    ],
                    [
                        'name'       => 'My name is John',
                        'age'        => 42,
                        'pigLatin'   => 'Ymay amenay isyay Ohnjay',
                        'occupation' => [
                            'name'      => 'Bartender',
                            'startDate' => '2017-01-01 10:10:10',
                        ],
                        'friends'    => [],
                    ],
                ],
            ],
        ], JSON_PRETTY_PRINT);

        $I->assertSame($expected, $output);
    }

}
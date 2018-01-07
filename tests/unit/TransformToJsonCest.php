<?php
declare(strict_types = 1);

namespace Test\Unit;

use Test\Unit\Support\Transformers\PersonArrayTransformer;
use UnitTester;
use Diaclone\Resource\Collection;
use Diaclone\Serializer\SimpleJsonSerializer;
use Diaclone\TransformService;
use Test\Unit\Support\Entities\Person;
use Test\Unit\Support\Transformers\PersonTransformer;

class TransformToJsonCest
{
    public function testTransformationAll(UnitTester $I)
    {
        $friends = [
            new Person('Paul', 'Real estate novelist'),
            new Person('John', 'Bartender'),
            new Person('Davy', 'Sailor'),
            new Person('Elizabeth', 'Waitress'),
        ];

        $output = (new TransformService(new SimpleJsonSerializer()))->transform(new Person('Bill', 'Piano Man',
            $friends), new PersonTransformer(), 'person');

        $expected = [
            'person' => [
                'name'       => 'My name is Bill',
                'age'        => 42,
                'pigLatin'   => 'Ymay amenay isyay Illbay',
                'occupation' => [
                    'name'      => 'Piano Man',
                    'startDate' => '2017-01-01T10:10:10+0000',
                ],
                'friends'    => [
                    [
                        'name'       => 'My name is Paul',
                        'age'        => 42,
                        'pigLatin'   => 'Ymay amenay isyay Aulpay',
                        'occupation' => [
                            'name'      => 'Real estate novelist',
                            'startDate' => '2017-01-01T10:10:10+0000',
                        ],
                        'friends'    => [],
                    ],
                    [
                        'name'       => 'My name is John',
                        'age'        => 42,
                        'pigLatin'   => 'Ymay amenay isyay Ohnjay',
                        'occupation' => [
                            'name'      => 'Bartender',
                            'startDate' => '2017-01-01T10:10:10+0000',
                        ],
                        'friends'    => [],
                    ],
                    [
                        'name'       => 'My name is Davy',
                        'age'        => 42,
                        'pigLatin'   => 'Ymay amenay isyay Avyday',
                        'occupation' => [
                            'name'      => 'Sailor',
                            'startDate' => '2017-01-01T10:10:10+0000',
                        ],
                        'friends'    => [],
                    ],
                    [
                        'name'       => 'My name is Elizabeth',
                        'age'        => 42,
                        'pigLatin'   => 'Ymay amenay isyay Elizabethyay',
                        'occupation' => [
                            'name'      => 'Waitress',
                            'startDate' => '2017-01-01T10:10:10+0000',
                        ],
                        'friends'    => [],
                    ],
                ],
            ],
        ];

        $I->assertEquals($expected, json_decode($output, true));
    }

    public function testUntransform(UnitTester $I)
    {
        $payload = [
            'name'       => 'My name is Bill',
            'age'        => 42,
            'occupation' => [
                'name'      => 'Piano Man',
                'startDate' => '2017-01-01 10:10:10',
            ],
            'friends'    => [
                [
                    'name'       => 'My name is Paul',
                    'age'        => 42,
                    'occupation' => [
                        'name'      => 'Real estate novelist',
                        'startDate' => '2017-01-01 10:10:10',
                    ],
                ],
                [
                    'name'       => 'My name is John',
                    'age'        => 42,
                    'occupation' => [
                        'name'      => 'Bartender',
                        'startDate' => '2017-01-01 10:10:10',
                    ],
                ],
                [
                    'name'       => 'My name is Davy',
                    'age'        => 42,
                    'occupation' => [
                        'name'      => 'Sailor',
                        'startDate' => '2017-01-01 10:10:10',
                    ],
                ],
                [
                    'name'       => 'My name is Elizabeth',
                    'age'        => 42,
                    'occupation' => [
                        'name'      => 'Waitress',
                        'startDate' => '2017-01-01 10:10:10',
                    ],
                ],
            ],
        ];

        $output = (new TransformService(new SimpleJsonSerializer()))->untransform($payload, new PersonArrayTransformer());

        $expected = [
            'name'       => 'My name is Bill',
            'age'        => 42,
            'my_job'     => [
                'name'       => 'Piano Man',
                'start_date' => '2017-01-01 10:10:10',
            ],
            'my_friends' => [
                [
                    'name'   => 'My name is Paul',
                    'age'    => 42,
                    'my_job' => [
                        'name'       => 'Real estate novelist',
                        'start_date' => '2017-01-01 10:10:10',
                    ],
                ],
                [
                    'name'   => 'My name is John',
                    'age'    => 42,
                    'my_job' => [
                        'name'       => 'Bartender',
                        'start_date' => '2017-01-01 10:10:10',
                    ],
                ],
                [
                    'name'   => 'My name is Davy',
                    'age'    => 42,
                    'my_job' => [
                        'name'       => 'Sailor',
                        'start_date' => '2017-01-01 10:10:10',
                    ],
                ],
                [
                    'name'   => 'My name is Elizabeth',
                    'age'    => 42,
                    'my_job' => [
                        'name'       => 'Waitress',
                        'start_date' => '2017-01-01 10:10:10',
                    ],
                ],
            ],
        ];
        $I->assertEquals($expected, $output);
    }

    public function testTransformationWithoutKey(UnitTester $I)
    {
        $output = (new TransformService(new SimpleJsonSerializer()))->transform(new Person('Bill', 'Piano Man'),
            new PersonTransformer());

        $expected = [
            'name'       => 'My name is Bill',
            'age'        => 42,
            'pigLatin'   => 'Ymay amenay isyay Illbay',
            'occupation' => [
                'name'      => 'Piano Man',
                'startDate' => '2017-01-01T10:10:10+0000',
            ],
            'friends'    => [],
        ];

        $I->assertEquals($expected, json_decode($output, true));
    }

    public function testTransformationCollectionAll(UnitTester $I)
    {
        $friends = [
            new Person('Paul', 'Real estate novelist'),
            new Person('John', 'Bartender'),
            new Person('Davy', 'Sailor'),
            new Person('Elizabeth', 'Waitress'),
        ];

        $output = (new TransformService(new SimpleJsonSerializer()))->transform($friends, new PersonTransformer(),
            'people', '*', Collection::class);

        $expected = [
            'people' => [
                [
                    'name'       => 'My name is Paul',
                    'age'        => 42,
                    'pigLatin'   => 'Ymay amenay isyay Aulpay',
                    'occupation' => [
                        'name'      => 'Real estate novelist',
                        'startDate' => '2017-01-01T10:10:10+0000',
                    ],
                    'friends'    => [],
                ],
                [
                    'name'       => 'My name is John',
                    'age'        => 42,
                    'pigLatin'   => 'Ymay amenay isyay Ohnjay',
                    'occupation' => [
                        'name'      => 'Bartender',
                        'startDate' => '2017-01-01T10:10:10+0000',
                    ],
                    'friends'    => [],
                ],
                [
                    'name'       => 'My name is Davy',
                    'age'        => 42,
                    'pigLatin'   => 'Ymay amenay isyay Avyday',
                    'occupation' => [
                        'name'      => 'Sailor',
                        'startDate' => '2017-01-01T10:10:10+0000',
                    ],
                    'friends'    => [],
                ],
                [
                    'name'       => 'My name is Elizabeth',
                    'age'        => 42,
                    'pigLatin'   => 'Ymay amenay isyay Elizabethyay',
                    'occupation' => [
                        'name'      => 'Waitress',
                        'startDate' => '2017-01-01T10:10:10+0000',
                    ],
                    'friends'    => [],
                ],
            ],
        ];

        $I->assertEquals($expected, json_decode($output, true));
    }

    public function testTransformationCollectionWithoutKey(UnitTester $I)
    {
        $friends = [
            new Person('Paul', 'Real estate novelist'),
            new Person('John', 'Bartender'),
            new Person('Davy', 'Sailor'),
            new Person('Elizabeth', 'Waitress'),
        ];

        $output = (new TransformService(new SimpleJsonSerializer()))->transform($friends, new PersonTransformer(), '',
            '*', Collection::class);

        $expected = [
            [
                'name'       => 'My name is Paul',
                'age'        => 42,
                'pigLatin'   => 'Ymay amenay isyay Aulpay',
                'occupation' => [
                    'name'      => 'Real estate novelist',
                    'startDate' => '2017-01-01T10:10:10+0000',
                ],
                'friends'    => [],
            ],
            [
                'name'       => 'My name is John',
                'age'        => 42,
                'pigLatin'   => 'Ymay amenay isyay Ohnjay',
                'occupation' => [
                    'name'      => 'Bartender',
                    'startDate' => '2017-01-01T10:10:10+0000',
                ],
                'friends'    => [],
            ],
            [
                'name'       => 'My name is Davy',
                'age'        => 42,
                'pigLatin'   => 'Ymay amenay isyay Avyday',
                'occupation' => [
                    'name'      => 'Sailor',
                    'startDate' => '2017-01-01T10:10:10+0000',
                ],
                'friends'    => [],
            ],
            [
                'name'       => 'My name is Elizabeth',
                'age'        => 42,
                'pigLatin'   => 'Ymay amenay isyay Elizabethyay',
                'occupation' => [
                    'name'      => 'Waitress',
                    'startDate' => '2017-01-01T10:10:10+0000',
                ],
                'friends'    => [],
            ],
        ];

        $I->assertEquals($expected, json_decode($output, true));
    }
}
<?php
declare(strict_types = 1);

namespace Test\Unit;

use Diaclone\Resource\Collection;
use Diaclone\TransformService;
use Test\Unit\Support\Entities\Person;
use Test\Unit\Support\Transformers\PersonTransformer;
use UnitTester;

class TransformCest
{
    public function testTransformationAll(UnitTester $I)
    {
        $friends = [
            new Person('Paul', 'Real estate novelist'),
            new Person('John', 'Bartender'),
            new Person('Davy', 'Sailor'),
            new Person('Elizabeth', 'Waitress'),
        ];
        $output = (new TransformService())->transform(new Person('Bill', 'Piano Man', $friends),
            new PersonTransformer(), 'person');
        $expected = [
            'person' => [
                'name'       => 'My name is Bill',
                'age'        => 42,
                'pigLatin'   => 'Ymay amenay isyay Illbay',
                'occupation' => [
                    'name' => 'Piano Man',
                ],
                'friends'    => [
                    [
                        'name'       => 'My name is Paul',
                        'age'        => 42,
                        'pigLatin'   => 'Ymay amenay isyay Aulpay',
                        'occupation' => [
                            'name' => 'Real estate novelist',
                        ],
                        'friends'    => [],
                    ],
                    [
                        'name'       => 'My name is John',
                        'age'        => 42,
                        'pigLatin'   => 'Ymay amenay isyay Ohnjay',
                        'occupation' => [
                            'name' => 'Bartender',
                        ],
                        'friends'    => [],
                    ],
                    [
                        'name'       => 'My name is Davy',
                        'age'        => 42,
                        'pigLatin'   => 'Ymay amenay isyay Avyday',
                        'occupation' => [
                            'name' => 'Sailor',
                        ],
                        'friends'    => [],
                    ],
                    [
                        'name'       => 'My name is Elizabeth',
                        'age'        => 42,
                        'pigLatin'   => 'Ymay amenay isyay Elizabethyay',
                        'occupation' => [
                            'name' => 'Waitress',
                        ],
                        'friends'    => [],
                    ],
                ],
            ],
        ];
        $I->assertEquals($expected, $output);
    }

    public function testUntransform(UnitTester $I)
    {
        $payload = [
            'name'       => 'My name is Bill',
            'age'        => 42,
            'occupation' => [
                'name' => 'Piano Man',
            ],
            'friends'    => [
                [
                    'name'       => 'My name is Paul',
                    'age'        => 42,
                    'occupation' => [
                        'name' => 'Real estate novelist',
                    ],
                ],
                [
                    'name'       => 'My name is John',
                    'age'        => 42,
                    'occupation' => [
                        'name' => 'Bartender',
                    ],
                ],
                [
                    'name'       => 'My name is Davy',
                    'age'        => 42,
                    'occupation' => [
                        'name' => 'Sailor',
                    ],
                ],
                [
                    'name'       => 'My name is Elizabeth',
                    'age'        => 42,
                    'occupation' => [
                        'name' => 'Waitress',
                    ],
                ],
            ],
        ];
        $output = (new TransformService())->untransform($payload, new PersonTransformer());

        $expected = [
            'name'       => 'My name is Bill',
            'age'        => 42,
            'my_job'     => [
                'name' => 'Piano Man',
            ],
            'my_friends' => [
                [
                    'name'   => 'My name is Paul',
                    'age'    => 42,
                    'my_job' => [
                        'name' => 'Real estate novelist',
                    ],
                ],
                [
                    'name'   => 'My name is John',
                    'age'    => 42,
                    'my_job' => [
                        'name' => 'Bartender',
                    ],
                ],
                [
                    'name'   => 'My name is Davy',
                    'age'    => 42,
                    'my_job' => [
                        'name' => 'Sailor',
                    ],
                ],
                [
                    'name'   => 'My name is Elizabeth',
                    'age'    => 42,
                    'my_job' => [
                        'name' => 'Waitress',
                    ],
                ],
            ],
        ];
        $I->assertEquals($expected, $output);
    }

    public function testTransformationWithoutKey(UnitTester $I)
    {
        $output = (new TransformService())->transform(new Person('Bill', 'Piano Man'), new PersonTransformer());
        $expected = [
            'name'       => 'My name is Bill',
            'age'        => 42,
            'pigLatin'   => 'Ymay amenay isyay Illbay',
            'occupation' => [
                'name' => 'Piano Man',
            ],
            'friends'    => [],
        ];

        $I->assertEquals($expected, $output);
    }

    public function testTransformationCollectionAll(UnitTester $I)
    {
        $friends = [
            new Person('Paul', 'Real estate novelist'),
            new Person('John', 'Bartender'),
            new Person('Davy', 'Sailor'),
            new Person('Elizabeth', 'Waitress'),
        ];
        $output = (new TransformService())->transform($friends, new PersonTransformer(), 'people', '*',
            Collection::class);
        $expected = [
            'people' => [
                [
                    'name'       => 'My name is Paul',
                    'age'        => 42,
                    'pigLatin'   => 'Ymay amenay isyay Aulpay',
                    'occupation' => [
                        'name' => 'Real estate novelist',
                    ],
                    'friends'    => [],
                ],
                [
                    'name'       => 'My name is John',
                    'age'        => 42,
                    'pigLatin'   => 'Ymay amenay isyay Ohnjay',
                    'occupation' => [
                        'name' => 'Bartender',
                    ],
                    'friends'    => [],
                ],
                [
                    'name'       => 'My name is Davy',
                    'age'        => 42,
                    'pigLatin'   => 'Ymay amenay isyay Avyday',
                    'occupation' => [
                        'name' => 'Sailor',
                    ],
                    'friends'    => [],
                ],
                [
                    'name'       => 'My name is Elizabeth',
                    'age'        => 42,
                    'pigLatin'   => 'Ymay amenay isyay Elizabethyay',
                    'occupation' => [
                        'name' => 'Waitress',
                    ],
                    'friends'    => [],
                ],
            ],
        ];
        $I->assertEquals($expected, $output);
    }

    public function testTransformationCollectionWithoutKey(UnitTester $I)
    {
        $friends = [
            new Person('Paul', 'Real estate novelist'),
            new Person('John', 'Bartender'),
            new Person('Davy', 'Sailor'),
            new Person('Elizabeth', 'Waitress'),
        ];
        $output = (new TransformService())->transform($friends, new PersonTransformer(), '', '*',
            Collection::class);
        $expected = [
            [
                'name'       => 'My name is Paul',
                'age'        => 42,
                'pigLatin'   => 'Ymay amenay isyay Aulpay',
                'occupation' => [
                    'name' => 'Real estate novelist',
                ],
                'friends'    => [],
            ],
            [
                'name'       => 'My name is John',
                'age'        => 42,
                'pigLatin'   => 'Ymay amenay isyay Ohnjay',
                'occupation' => [
                    'name' => 'Bartender',
                ],
                'friends'    => [],
            ],
            [
                'name'       => 'My name is Davy',
                'age'        => 42,
                'pigLatin'   => 'Ymay amenay isyay Avyday',
                'occupation' => [
                    'name' => 'Sailor',
                ],
                'friends'    => [],
            ],
            [
                'name'       => 'My name is Elizabeth',
                'age'        => 42,
                'pigLatin'   => 'Ymay amenay isyay Elizabethyay',
                'occupation' => [
                    'name' => 'Waitress',
                ],
                'friends'    => [],
            ],
        ];
        $I->assertEquals($expected, $output);
    }
}
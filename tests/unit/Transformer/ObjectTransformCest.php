<?php
declare(strict_types = 1);

namespace Test\Unit\Transformer;

use Diaclone\Resource\ObjectCollection;
use Diaclone\Resource\ObjectItem;
use Test\Unit\Support\Transformers\PersonObjectTransformer;
use UnitTester;
use Test\Unit\Support\Entities\Person;

class ObjectTransformCest
{
    public function testToArray(UnitTester $I)
    {
        $friends = [
            new Person('Paul', 'Real estate novelist'),
            new Person('John', 'Bartender'),
            new Person('Davy', 'Sailor'),
            new Person('Elizabeth', 'Waitress'),
        ];

        $person = new Person('Bill', 'Piano Man', $friends);
        $resource = new ObjectItem($person);
        $output = (new PersonObjectTransformer())->toArray($resource);
        $expected = [
            'name' => 'My name is Bill',
            'age' => 42,
            'pigLatin' => 'Ymay amenay isyay Illbay',
            'occupation' => [
                'name' => 'Piano Man',
                'startDate' => '2017-01-01T10:10:10+00:00',
            ],
            'friends' => [
                [
                    'name' => 'My name is Paul',
                    'age' => 42,
                    'pigLatin' => 'Ymay amenay isyay Aulpay',
                    'occupation' => [
                        'name' => 'Real estate novelist',
                        'startDate' => '2017-01-01T10:10:10+00:00',
                    ],
                    'friends' => [],
                ],
                [
                    'name' => 'My name is John',
                    'age' => 42,
                    'pigLatin' => 'Ymay amenay isyay Ohnjay',
                    'occupation' => [
                        'name' => 'Bartender',
                        'startDate' => '2017-01-01T10:10:10+00:00',
                    ],
                    'friends' => [],
                ],
                [
                    'name' => 'My name is Davy',
                    'age' => 42,
                    'pigLatin' => 'Ymay amenay isyay Avyday',
                    'occupation' => [
                        'name' => 'Sailor',
                        'startDate' => '2017-01-01T10:10:10+00:00',
                    ],
                    'friends' => [],
                ],
                [
                    'name' => 'My name is Elizabeth',
                    'age' => 42,
                    'pigLatin' => 'Ymay amenay isyay Elizabethyay',
                    'occupation' => [
                        'name' => 'Waitress',
                        'startDate' => '2017-01-01T10:10:10+00:00',
                    ],
                    'friends' => [],
                ],
            ],
        ];
        $I->assertEquals($expected, $output);
    }

    public function testToObject(UnitTester $I)
    {
        $payload = [
            'name' => 'Bill',
            'age' => 42,
            'occupation' => [
                'name' => 'Piano Man',
            ],
            'friends' => [
                [
                    'name' => 'Paul',
                    'age' => 42,
                    'occupation' => [
                        'name' => 'Real estate novelist',
                        'startDate' => '2017-01-01T10:10:10+00:00',
                    ],
                ],
                [
                    'name' => 'John',
                    'age' => 42,
                    'occupation' => [
                        'name' => 'Bartender',
                        'startDate' => '2017-01-01T10:10:10+00:00',
                    ],
                ],
                [
                    'name' => 'Davy',
                    'age' => 42,
                    'occupation' => [
                        'name' => 'Sailor',
                        'startDate' => '2017-01-01T10:10:10+00:00',
                    ],
                ],
                [
                    'name' => 'Elizabeth',
                    'age' => 42,
                    'occupation' => [
                        'name' => 'Waitress',
                        'startDate' => '2017-01-01T10:10:10+00:00',
                    ],
                ],
            ],
        ];
        $resource = new ObjectItem($payload);
        $output = (new PersonObjectTransformer())->toObject($resource);
        $friends = [
            new Person('Paul', 'Real estate novelist'),
            new Person('John', 'Bartender'),
            new Person('Davy', 'Sailor'),
            new Person('Elizabeth', 'Waitress'),
        ];

        $expected = new Person('Bill', 'Piano Man', $friends);
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

        $resource = new ObjectCollection($friends);
        $output = (new PersonObjectTransformer())->toArray($resource);
        $expected = [
            [
                'name' => 'My name is Paul',
                'age' => 42,
                'pigLatin' => 'Ymay amenay isyay Aulpay',
                'occupation' => [
                    'name' => 'Real estate novelist',
                    'startDate' => '2017-01-01T10:10:10+00:00',
                ],
                'friends' => [],
            ],
            [
                'name' => 'My name is John',
                'age' => 42,
                'pigLatin' => 'Ymay amenay isyay Ohnjay',
                'occupation' => [
                    'name' => 'Bartender',
                    'startDate' => '2017-01-01T10:10:10+00:00',
                ],
                'friends' => [],
            ],
            [
                'name' => 'My name is Davy',
                'age' => 42,
                'pigLatin' => 'Ymay amenay isyay Avyday',
                'occupation' => [
                    'name' => 'Sailor',
                    'startDate' => '2017-01-01T10:10:10+00:00',
                ],
                'friends' => [],
            ],
            [
                'name' => 'My name is Elizabeth',
                'age' => 42,
                'pigLatin' => 'Ymay amenay isyay Elizabethyay',
                'occupation' => [
                    'name' => 'Waitress',
                    'startDate' => '2017-01-01T10:10:10+00:00',
                ],
                'friends' => [],
            ],
        ];
        $I->assertEquals($expected, $output);
    }
}
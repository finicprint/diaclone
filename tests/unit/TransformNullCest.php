<?php
declare(strict_types = 1);

use Diaclone\TransformService;
use Test\Unit\Support\Entities\Person;
use Test\Unit\Support\Transformers\PersonTransformer;

class TransformNullCest
{
    public function testTransformationNull(UnitTester $I)
    {
        $output = (new TransformService())->transform([], new PersonTransformer(), 'person');

        $expected = [
            'person' => [],
        ];

        $I->assertEquals($expected, $output);
    }

    public function testTransformationNullNoKey(UnitTester $I)
    {
        $output = (new TransformService())->transform([], new PersonTransformer());

        $expected = [];

        $I->assertEquals($expected, $output);
    }

    public function testTransformationNullChild(UnitTester $I)
    {
        $friends = [
            new Person('Paul', 'Real estate novelist'),
            new Person('John', 'Bartender'),
            [],
            null,
        ];

        $output = (new TransformService())->transform(new Person('Bill', 'Piano Man', $friends), new PersonTransformer(), 'person');

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
                ],
            ],
        ];

        $I->assertEquals($expected, $output);
    }

    public function testTransformationNullChildNoKey(UnitTester $I)
    {
        $friends = [
            new Person('Paul', 'Real estate novelist'),
            new Person('John', 'Bartender'),
            [],
            null,
        ];

        $output = (new TransformService())->transform(new Person('Bill', 'Piano Man', $friends), new PersonTransformer());

        $expected = [
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
            ],

        ];

        $I->assertEquals($expected, $output);
    }
}
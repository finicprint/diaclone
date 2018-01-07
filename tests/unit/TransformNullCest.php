<?php
declare(strict_types = 1);

namespace Test\Unit;

use UnitTester;
use Diaclone\Resource\Item;
use Diaclone\TransformService;
use Test\Unit\Support\Entities\Credential;
use Test\Unit\Support\Entities\Person;
use Test\Unit\Support\Transformers\CredentialIntegerTransformer;
use Test\Unit\Support\Transformers\CredentialTransformer;
use Test\Unit\Support\Transformers\PersonTransformer;

class TransformNullCest
{
    public function testTransformNull(UnitTester $I)
    {
        $resource = new Item([]);
        $output = (new PersonTransformer())->transform($resource);

        $expected = null;

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

        $data = new Person('Bill', 'Piano Man', $friends);
        $resource = new Item($data);
        $output = (new PersonTransformer())->transform($resource);

        $expected = [
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
            ],

        ];

        $I->assertSame($expected, $output);
    }

    public function testTransformationNullStringProperty(UnitTester $I)
    {
        $cred = new Credential('user', null);

        $output = (new TransformService())->transform($cred, new CredentialTransformer(), 'credential');

        $expected = [
            'credential' => [
                'username' => 'user',
                'password' => '',
            ],
        ];

        $I->assertSame($expected, $output);
    }

    public function testTransformationNullIntegerProperty(UnitTester $I)
    {
        $cred = new Credential('user', null);

        $output = (new TransformService())->transform($cred, new CredentialIntegerTransformer(), 'credential');

        $expected = [
            'credential' => [
                'username' => 'user',
                'password' => 0,
            ],
        ];

        $I->assertSame($expected, $output);
    }
}
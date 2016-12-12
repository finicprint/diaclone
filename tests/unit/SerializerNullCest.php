<?php
declare(strict_types = 1);

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

        $expected = '{
    "name": "My name is Bill",
    "age": 42,
    "pigLatin": "Ymay amenay isyay Illbay",
    "occupation": null,
    "friends": []
}';

        $output = (new TransformService(new SimpleJsonSerializer()))->transform($person, new PersonTransformer());

        $I->assertSame($expected, $output);
    }


    public function testSerializerNull(UnitTester $I)
    {
        $output = (new TransformService(new SimpleJsonSerializer()))->transform([], new PersonTransformer(), 'person');

        $expected = <<<'JSON'
{
    "person": {}
}
JSON;

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

        $output = (new TransformService(new SimpleJsonSerializer()))->transform(new Person('Bill', 'Piano Man', $friends), new PersonTransformer(), 'person');

        $expected = '{
    "person": {
        "name": "My name is Bill",
        "age": 42,
        "pigLatin": "Ymay amenay isyay Illbay",
        "occupation": {
            "name": "Piano Man"
        },
        "friends": [
            {
                "name": "My name is Paul",
                "age": 42,
                "pigLatin": "Ymay amenay isyay Aulpay",
                "occupation": {
                    "name": "Real estate novelist"
                },
                "friends": []
            },
            {
                "name": "My name is John",
                "age": 42,
                "pigLatin": "Ymay amenay isyay Ohnjay",
                "occupation": {
                    "name": "Bartender"
                },
                "friends": []
            }
        ]
    }
}';

        $I->assertSame($expected, $output);
    }

}
<?php
declare(strict_types=1);

namespace Test\Unit;

use UnitTester;
use Diaclone\Resource\Object;
use Test\Unit\Support\Connector\TestConnector;
use Diaclone\ConnectorTransformService;
use Test\Unit\Support\Entities\Person;
use Test\Unit\Support\Transformers\PersonTransformer;
use Diaclone\Connector\Connector;

require __DIR__ . '/../../vendor/autoload.php';

use Elasticsearch\ClientBuilder;

class ConnectorTransformCest
{
    public function testTransformationAll(UnitTester $I)
    {
        $friends = [
            Person::create('Paul', 'Real estate novelist'),
            Person::create('John', 'Bartender'),
            Person::create('Davy', 'Sailor'),
            Person::create('Elizabeth', 'Waitress'),
        ];

        $connector = new TestConnector();
        $connector->setData(Person::create('Bill', 'Piano Man', $friends));

        (new ConnectorTransformService())->transform(
            $connector,
            new PersonTransformer()
        );
        $output = $connector->getOutgoingData();
        $expected = [
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
                [
                    'name'       => 'My name is Davy',
                    'age'        => 42,
                    'pigLatin'   => 'Ymay amenay isyay Avyday',
                    'occupation' => [
                        'name'      => 'Sailor',
                        'startDate' => '2017-01-01 10:10:10',
                    ],
                    'friends'    => [],
                ],
                [
                    'name'       => 'My name is Elizabeth',
                    'age'        => 42,
                    'pigLatin'   => 'Ymay amenay isyay Elizabethyay',
                    'occupation' => [
                        'name'      => 'Waitress',
                        'startDate' => '2017-01-01 10:10:10',
                    ],
                    'friends'    => [],
                ],
            ],
        ];
        $I->assertEquals($expected, $output);
    }

    public function testUntransform(UnitTester $I)
    {
        $payload = [
            'name'       => 'Bill',
            'age'        => 21,
            'occupation' => [
                'name' => 'Piano Man',
            ],
            'friends'    => [
                [
                    'name'       => 'Paul',
                    'age'        => 42,
                    'occupation' => [
                        'name'      => 'Real estate novelist',
                        'startDate' => '2017-01-01 10:10:10',
                    ],
                ],
                [
                    'name'       => 'John',
                    'age'        => 42,
                    'occupation' => [
                        'name'      => 'Bartender',
                        'startDate' => '2017-01-01 10:10:10',
                    ],
                ],
                [
                    'name'       => 'Davy',
                    'age'        => 42,
                    'occupation' => [
                        'name'      => 'Sailor',
                        'startDate' => '2017-01-01 10:10:10',
                    ],
                ],
                [
                    'name'       => 'Elizabeth',
                    'age'        => 42,
                    'occupation' => [
                        'name'      => 'Waitress',
                        'startDate' => '2017-01-01 10:10:10',
                    ],
                ],
            ],
        ];
        $connector = new TestConnector($payload);

        (new ConnectorTransformService())->untransform($connector, new PersonTransformer(), Object::class);

        /** @var Person $person */
        $person = $connector->getData();
        $I->assertInstanceOf(Person::class, $person, 'A Person object should have been returned');
        $I->assertEquals('My name is Bill', $person->getName());
        $I->assertEquals(21, $person->getAge());
        $I->assertEquals('Piano Man', $person->my_job->getName());
        $friends = [
            'My name is Paul'      => 'Real estate novelist',
            'My name is John'      => 'Bartender',
            'My name is Davy'      => 'Sailor',
            'My name is Elizabeth' => 'Waitress',
        ];
        foreach ($person->getMyFriends() as $friend) {
            $I->assertInstanceOf(Person::class, $friend, 'A Person object should have been returned');
            $name = $friend->getName();
            $I->assertSame($friends[$name], $friend->my_job->getName());
        }
    }

    public function testTransformationESConnector(UnitTester $I)
    {
        $ESClass =  Connector::getConnectorClassByType('elasticsearch');
        $ESConnector =  new $ESClass(ClientBuilder::create()->build(), ['index' => 'people', 'type' => 'test', 'id' => '1']);
        $ESConnector->setData(Person::create('Bill', 'Piano Man'));

        (new ConnectorTransformService())->transform($ESConnector, new PersonTransformer());

        $output = $ESConnector->getDataFromSource();
        $expected = [
            'name'       => 'My name is Bill',
            'age'        => 42,
            'pigLatin'   => 'Ymay amenay isyay Illbay',
            'occupation' => [
                'name'      => 'Piano Man',
                'startDate' => '2017-01-01 10:10:10',
            ],
            'friends'    => [],
        ];
        $I->assertEquals($expected, $output['_source']);

    }
}

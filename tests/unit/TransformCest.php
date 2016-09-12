<?php
declare(strict_types = 1);

use Diaclone\Resource\ResourceInterface;
use Diaclone\Resource\Collection;
use Diaclone\Transformer\AbstractTransformer;
use Diaclone\Transformer\IntegerTransformer;
use Diaclone\Transformer\StringTransformer;
use Diaclone\TransformService;

class TransformCest
{
    public function testTransformationAll(UnitTester $I)
    {
        $friends = [
            new Person('Paul', 'Real estate novelist'),
            new Person('John', 'Bartender'),
            new Person('Davy', 'Sailor'),
            new Person('Unknown', 'Waitress'),
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
                        'name'       => 'My name is Unknown',
                        'age'        => 42,
                        'pigLatin'   => 'Ymay amenay isyay Unknownyay',
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
            'person' => [
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
                        'name'       => 'My name is Unknown',
                        'age'        => 42,
                        'occupation' => [
                            'name' => 'Waitress',
                        ],
                    ],
                ],
            ],
        ];
        $output = (new TransformService())->untransform($payload, new PersonTransformer());

        $expected = [
            'person' => [
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
                        'name'   => 'My name is Unknown',
                        'age'    => 42,
                        'my_job' => [
                            'name' => 'Waitress',
                        ],
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
            new Person('Unknown', 'Waitress'),
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
                    'name'       => 'My name is Unknown',
                    'age'        => 42,
                    'pigLatin'   => 'Ymay amenay isyay Unknownyay',
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
            new Person('Unknown', 'Waitress'),
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
                'name'       => 'My name is Unknown',
                'age'        => 42,
                'pigLatin'   => 'Ymay amenay isyay Unknownyay',
                'occupation' => [
                    'name' => 'Waitress',
                ],
                'friends'    => [],
            ],
        ];
        $I->assertEquals($expected, $output);
    }
}

class Person
{
    public $my_job;

    protected $friends;
    protected $name;

    public function __construct($name, $occupation, $friends = [])
    {
        $this->friends = $friends;
        $this->name = $name;
        $this->my_job = new Occupation($occupation);
    }

    public function getAge()
    {
        return 42;
    }

    public function getName()
    {
        return 'My name is ' . $this->name;
    }

    public function getNunya()
    {
        return 'secret';
    }

    public function getMyFriends()
    {
        return $this->friends;
    }
}

class PersonTransformer extends AbstractTransformer
{
    protected static $dataTypes = [
        'my_friends' => Collection::class,
    ];

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
}

class Occupation
{
    protected $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}

class OccupationTransformer extends AbstractTransformer
{
    protected static $transformers = [
        'name' => StringTransformer::class,
    ];

    protected static $mappedProperties = [
        'name' => 'name',
    ];
}

class PigLatinTransformer extends AbstractTransformer
{
    public function transform(ResourceInterface $resource)
    {
        $value = $this->getPropertyValue($resource->getData(), 'name');
        $parts = explode(' ', $value);
        $converted = [];
        foreach ($parts as $part) {
            $firstLetter = lcfirst($part[0]);
            if (in_array($firstLetter, ['a', 'e', 'i', 'o', 'u',])) {
                $converted[] = $part . 'yay';
            } else {
                $pigged = substr($part, 1) . $firstLetter . 'ay';
                if ($firstLetter !== $part[0]) {
                    $pigged = ucfirst($pigged);
                }

                $converted[] = $pigged;
            }
        }

        return implode(' ', $converted);
    }
}
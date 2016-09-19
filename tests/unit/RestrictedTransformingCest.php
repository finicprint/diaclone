<?php
declare(strict_types = 1);

use Diaclone\Transformer\{
    AbstractTransformer, InputOnlyStringTransformer, OutputOnlyStringTransformer, StringTransformer
};
use Diaclone\TransformService;

class RestrictedTransformingCest
{
    public function testUnallowedInput(UnitTester $I)
    {
        $output = (new TransformService())->untransform(['credential' => ['username' => 'user', 'password' => '8675309']],
            new CredentialInputTransformerTransformer());
        $expected = [
            'credential' => [
                'UserName' => 'user',
            ],
        ];
        $I->assertEquals($expected, $output);

        $output = (new TransformService())->transform(new Credential('user', '8675309'),
            new CredentialInputTransformerTransformer(), 'credential');
        $expected = [
            'credential' => [
                'username' => 'user',
                'password' => '8675309',
            ],
        ];
        $I->assertEquals($expected, $output);
    }

    public function testUnallowedOutput(UnitTester $I)
    {
        $output = (new TransformService())->transform(new Credential('user', '8675309'),
            new CredentialOutputTransformerTransformer(), 'credential');
        $expected = [
            'credential' => [
                'username' => 'user',
            ],
        ];
        $I->assertEquals($expected, $output);

        $output = (new TransformService())->untransform(['credential' => ['username' => 'user', 'password' => '8675309']],
            new CredentialOutputTransformerTransformer());
        $expected = [
            'credential' => [
                'UserName' => 'user',
                'Password' => '8675309',
            ],
        ];
        $I->assertEquals($expected, $output);
    }
}

class CredentialInputTransformerTransformer extends AbstractTransformer
{
    protected static $transformers = [
        'UserName' => StringTransformer::class,
        'Password' => OutputOnlyStringTransformer::class,
    ];

    protected static $mappedProperties = [
        'UserName' => 'username',
        'Password' => 'password',
    ];
}

class CredentialOutputTransformerTransformer extends AbstractTransformer
{
    protected static $transformers = [
        'UserName' => StringTransformer::class,
        'Password' => InputOnlyStringTransformer::class,
    ];

    protected static $mappedProperties = [
        'UserName' => 'username',
        'Password' => 'password',
    ];
}

class Credential
{
    protected $password;
    protected $username;

    public function __construct($username, $password)
    {
        $this->password = $password;
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getUserName()
    {
        return $this->username;
    }
}
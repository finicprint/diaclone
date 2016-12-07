<?php
declare(strict_types = 1);

use Diaclone\TransformService;
use Test\Unit\Support\Entities\Credential;
use Test\Unit\Support\Transformers\CredentialInputTransformer;
use Test\Unit\Support\Transformers\CredentialOutputTransformer;

class RestrictedTransformingCest
{
    public function testUnallowedInput(UnitTester $I)
    {
        $output = (new TransformService())->untransform(['username' => 'user', 'password' => '8675309'],
            new CredentialInputTransformer());

        $expected = [
            'UserName' => 'user',
        ];

        $I->assertEquals($expected, $output);

        $output = (new TransformService())->transform(new Credential('user', '8675309'),
            new CredentialInputTransformer(), 'credential');

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
            new CredentialOutputTransformer(), 'credential');

        $expected = [
            'credential' => [
                'username' => 'user',
            ],
        ];

        $I->assertEquals($expected, $output);

        $output = (new TransformService())->untransform(['username' => 'user', 'password' => '8675309'],
            new CredentialOutputTransformer());

        $expected = [
            'UserName' => 'user',
            'Password' => '8675309',
        ];

        $I->assertEquals($expected, $output);
    }
}

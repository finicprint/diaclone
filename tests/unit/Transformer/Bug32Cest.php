<?php
declare(strict_types=1);

namespace Test\Unit\Transformer;

use Diaclone\Resource\ObjectItem;
use Test\Unit\Support\Entities\Password;
use Test\Unit\Support\Transformers\PayloadToPasswordTransformer;
use UnitTester;

class Bug32Cest
{
    public function testToArray(UnitTester $I)
    {
        $password = Password::fromString('password1');

        $resources = new ObjectItem($password);

        $hash = (new PayloadToPasswordTransformer())->toArray($resources);

        $I->assertStringStartsWith('$2y$', $hash);
    }

    public function testToObject(UnitTester $I)
    {
        $resources = new ObjectItem('password1');

        $password = (new PayloadToPasswordTransformer())->toObject($resources);

        $I->assertInstanceOf(Password::class, $password);
    }
}

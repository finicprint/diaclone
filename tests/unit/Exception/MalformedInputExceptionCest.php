<?php
declare(strict_types=1);

namespace Test\Unit\Exception;

use Diaclone\Exception\MalformedInputException;
use Test\Unit\Support\Transformers\PersonObjectTransformer;
use UnitTester;

class MalformedInputExceptionCest
{
    public function testMessage(UnitTester $I)
    {
        $fields = [
            'alpha',
            'beta',
            'gamma',
        ];
        $transformer = new PersonObjectTransformer();
        $exception = new MalformedInputException($fields, $transformer);
        $expected = 'Problems un-transforming alpha, beta, gamma in Test\Unit\Support\Transformers\PersonObjectTransformer';
        $I->assertSame($expected, $exception->getMessage());
    }
}
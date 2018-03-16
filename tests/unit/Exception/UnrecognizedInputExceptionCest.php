<?php
declare(strict_types=1);

namespace Test\Unit\Exception;

use Diaclone\Exception\UnrecognizedInputException;
use Test\Unit\Support\Transformers\PersonObjectTransformer;
use UnitTester;

class UnrecognizedInputExceptionCest
{
    public function testMessage(UnitTester $I)
    {
        $fields = [
            'alpha',
            'beta',
            'gamma',
        ];
        $transformer = new PersonObjectTransformer();
        $exception = new UnrecognizedInputException($fields, $transformer);
        $expected = 'Unrecognized input fields: alpha, beta, gamma in Test\Unit\Support\Transformers\PersonObjectTransformer';
        $I->assertSame($expected, $exception->getMessage());
    }
}
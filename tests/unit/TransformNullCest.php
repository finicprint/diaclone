<?php
declare(strict_types = 1);

use Diaclone\TransformService;
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
}
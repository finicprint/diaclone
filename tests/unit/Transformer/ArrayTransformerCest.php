<?php
declare(strict_types = 1);

use Diaclone\Resource\Item;
use Diaclone\Transformer\ArrayTransformer;

class ArrayTransformerCest
{
    public function testTransformSimple(UnitTester $I)
    {
        $transformer = new ArrayTransformer();
        $data = [
            'test' => '1',
            0 => 3
        ];
        $resource = new Item($data);

        $transformed = $transformer->transform($resource);

        $I->assertSame($data, $transformed);
    }

    public function testUntransformSimple(UnitTester $I)
    {
        $transformer = new ArrayTransformer();
        $data = [
            'test' => '1',
            0 => 3
        ];
        $resource = new Item($data);

        $transformed = $transformer->untransform($resource);

        $I->assertSame($data, $transformed);
    }
}

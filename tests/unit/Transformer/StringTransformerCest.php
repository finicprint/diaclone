<?php
declare(strict_types = 1);

use Diaclone\Resource\Item;
use Diaclone\Transformer\StringTransformer;

class StringTransformerCest
{
    public function testTransformEmoji(UnitTester $I)
    {
        $transformer = new StringTransformer();
        $data = 'String with emoji :emoji-1f602:';
        $resource = new Item($data);

        $transformed = $transformer->transform($resource);

        $I->assertEquals('String with emoji ' . "\xF0\x9F\x98\x82", $transformed);
    }

    public function testUntransformEmoji(UnitTester $I)
    {
        $transformer = new StringTransformer();
        $data = 'String with emoji ' . "\xF0\x9F\x98\x82";
        $resource = new Item($data);

        $untransformed = $transformer->untransform($resource);

        $I->assertEquals('String with emoji :emoji-1f602:', $untransformed);
    }
}

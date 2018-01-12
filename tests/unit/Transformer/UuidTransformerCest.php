<?php
declare(strict_types=1);

namespace Test\Unit\Transformer;

use Diaclone\Resource\Item;
use Diaclone\Transformer\UuidTransformer;
use Ramsey\Uuid\Uuid;
use UnitTester;

class UuidTransformerCest
{
    public function testTransform(UnitTester $I)
    {
        $transformer = new UuidTransformer();
        $resource = new Item(Uuid::fromString('9b76ac3e-5211-454e-9404-3a638cf9a2d9'));
        $uuid = $transformer->transform($resource);
        $I->assertSame('9b76ac3e-5211-454e-9404-3a638cf9a2d9', $uuid);
    }

    public function testUntransform(UnitTester $I)
    {
        $transformer = new UuidTransformer();
        $resource = new Item('9b76ac3e-5211-454e-9404-3a638cf9a2d9');
        $uuid = $transformer->untransform($resource);
        $I->assertEquals(Uuid::fromString('9b76ac3e-5211-454e-9404-3a638cf9a2d9'), $uuid);
    }
}
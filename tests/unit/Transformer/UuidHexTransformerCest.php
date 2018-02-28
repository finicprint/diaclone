<?php
declare(strict_types=1);

namespace Test\Unit\Transformer;

use Diaclone\Resource\Item;
use Diaclone\Transformer\UuidHexTransformer;
use Ramsey\Uuid\Uuid;
use UnitTester;

class UuidHexTransformerCest
{
    public function testTransform(UnitTester $I)
    {
        $transformer = new UuidHexTransformer();
        $resource = new Item(Uuid::fromString('9b76ac3e-5211-454e-9404-3a638cf9a2d9'));
        $uuid = $transformer->transform($resource);
        $I->assertSame('9b76ac3e5211454e94043a638cf9a2d9', $uuid);
    }
}
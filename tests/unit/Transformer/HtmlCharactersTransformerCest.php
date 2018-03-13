<?php
declare(strict_types = 1);

use Diaclone\Resource\Item;
use Diaclone\Transformer\HtmlCharactersTransformer;

class HtmlCharactersTransformerCest
{
    public function testTransform(UnitTester $I)
    {
        $transformer = new HtmlCharactersTransformer();
        $data = '<p>Html String</p>';
        $resource = new Item($data);

        $transformed = $transformer->transform($resource);

        $I->assertEquals('&lt;p&gt;Html String&lt;/p&gt;', $transformed);
    }

    public function testUntransform(UnitTester $I)
    {
        $transformer = new HtmlCharactersTransformer();
        $data = '&lt;p&gt;Html String&lt;/p&gt;';
        $resource = new Item($data);

        $untransformed = $transformer->untransform($resource);

        $I->assertEquals('<p>Html String</p>', $untransformed);
    }
}

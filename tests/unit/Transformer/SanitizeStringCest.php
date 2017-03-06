<?php
declare(strict_types = 1);

use Diaclone\Resource\Item;
use Diaclone\Transformer\StringTransformer;

class SanitizeStringCest
{
    public function testUntransformHtml(UnitTester $I)
    {
        $transformer = new StringTransformer();

        $data = 'intro summary... &middot; HTML special characters';
        $resource = new Item($data);

        $expected = 'intro summary... · HTML special characters';
        $actual = $transformer->untransform($resource);

        $I->assertSame($expected, $actual);
    }

    public function testTransformHtml(UnitTester $I)
    {
        $transformer = new StringTransformer();

        $data = 'intro summary... · HTML special characters';
        $resource = new Item($data);

        $expected = 'intro summary... &middot; HTML special characters';
        $actual = $transformer->transform($resource);

        $I->assertSame($expected, $actual);
    }

    public function testUntransformBadHtml(UnitTester $I)
    {
        $transformer = new StringTransformer();

        $payload = 'intro <script>alert("xss");</script> summary... &middot; HTML special characters';
        $resource = new Item($payload);

        $internal = $transformer->untransform($resource);
        $actual = $transformer->transform(new Item($internal));

        $expected = 'intro &lt;script&gt;alert(&quot;xss&quot;);&lt;/script&gt; summary... &middot; HTML special characters';

        $I->assertSame($expected, $actual);
    }
}
<?php
declare(strict_types = 1);

use Carbon\Carbon;
use Diaclone\Resource\Item;
use Diaclone\Transformer\DateTimeIso8601Transformer;

class DateTimeIso8601TransformerCest
{
    public function testTransform(UnitTester $I)
    {
        $transformer = new DateTimeIso8601Transformer();
        $resource = new Item(new DateTime('2016-09-21 08:53:00', new DateTimeZone("UTC")));

        $isoDateTime = $transformer->transform($resource);

        $I->assertSame('2016-09-21T08:53:00+00:00', $isoDateTime);
    }

    public function testJavascriptUntransform(UnitTester $I)
    {
        $transformer = new DateTimeIso8601Transformer();
        $resource = new Item('2016-10-21T20:16:46.000Z');
        $dateTime = $transformer->untransform($resource);

        $I->assertEquals(new Carbon('2016-10-21 20:16:46', new DateTimeZone("UTC")), $dateTime);
    }

    public function testIOSUntransform(UnitTester $I)
    {
        $transformer = new DateTimeIso8601Transformer();
        $resource = new Item('2016-01-12T17:00:00Z');
        $dateTime = $transformer->untransform($resource);

        $I->assertEquals(new Carbon('2016-01-12 17:00:00',  new DateTimeZone("UTC")), $dateTime);
    }

    public function testEmptyStringTransform(UnitTester $I)
    {
        $transformer = new DateTimeIso8601Transformer();
        $resource = new Item('');

        $isoDateTime = $transformer->transform($resource);

        $I->assertSame('', $isoDateTime);
    }

    public function testNullTransform(UnitTester $I)
    {
        $transformer = new DateTimeIso8601Transformer();
        $resource = new Item(null);

        $isoDateTime = $transformer->transform($resource);

        $I->assertSame('', $isoDateTime);
    }

    public function testEmptyStringUntransform(UnitTester $I)
    {
        $transformer = new DateTimeIso8601Transformer();
        $resource = new Item('');
        $dateTime = $transformer->untransform($resource);

        $I->assertNull($dateTime);
    }
}

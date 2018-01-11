<?php
declare(strict_types=1);

namespace Test\Unit\Support\Transformer;

use DateTime;
use DateTimeZone;
use Diaclone\Resource\Item;
use Diaclone\Transformer\TimestampTransformer;
use UnitTester;

class TimestampTransformerCest
{
    public function testTransform(UnitTester $I)
    {
        $transformer = new TimestampTransformer();
        $resource = new Item(new DateTime('2008-09-29 00:00:00', new DateTimeZone("UTC")));
        $timestamp = $transformer->transform($resource);
        $I->assertEquals(1222646400, $timestamp);
    }

    public function testTransformFromString(UnitTester $I)
    {
        $transformer = new TimestampTransformer();
        $resource = new Item('2008-09-29 00:00:00');
        $timestamp = $transformer->transform($resource);
        $I->assertEquals(1222646400, $timestamp);
    }

    public function testUntransform(UnitTester $I)
    {
        $transformer = new TimestampTransformer();
        $resource = new Item(1222646400);
        $dateTime = $transformer->untransform($resource);
        $I->assertEquals(new DateTime('2008-09-29 00:00:00', new DateTimeZone("UTC")), $dateTime);
    }

    public function testUntransformFromString(UnitTester $I)
    {
        $transformer = new TimestampTransformer();
        $resource = new Item('1222646400');
        $dateTime = $transformer->untransform($resource);
        $I->assertEquals(new DateTime('2008-09-29 00:00:00', new DateTimeZone("UTC")), $dateTime);
    }
}
<?php
declare(strict_types=1);

namespace TestUnit\Transformer;

use Diaclone\Exception\TransformException;
use Diaclone\Resource\Item;
use Diaclone\Resource\ObjectItem;
use Test\Unit\Support\Entities\ColorType;
use Test\Unit\Support\Entities\Profile;
use Test\Unit\Support\Transformers\ColorTypeTransformer;
use Test\Unit\Support\Transformers\ProfileTransformer;
use UnitTester;

class AbstractEnumTransformerCest
{
    public function testTransform(UnitTester $I)
    {
        $transformer = new ColorTypeTransformer();
        $resource = new Item(ColorType::byValue(ColorType::BLUE));

        $blue = $transformer->transform($resource);

        $I->assertSame('blue', $blue);
    }

    public function testUntransform(UnitTester $I)
    {
        $transformer = new ColorTypeTransformer();
        $resource = new Item('red');

        $redType = $transformer->untransform($resource);

        $I->assertSame(ColorType::byName('RED'), $redType);
    }

    public function testTransformInObject(UnitTester $I)
    {
        $transformer = new ProfileTransformer();
        $profile = (new Profile())
            ->setFavoriteColor(ColorType::byValue(ColorType::GREEN));
        $resource = new ObjectItem($profile);

        $data = $transformer->transform($resource);

        $expected = [
            'favoriteColor' => 'green',
        ];

        $I->assertSame($expected, $data);
    }

    public function testTransformNullInObject(UnitTester $I)
    {
        $transformer = new ProfileTransformer();
        $profile = (new Profile());
        $resource = new ObjectItem($profile);

        $data = $transformer->transform($resource);

        $expected = [
            'favoriteColor' => null,
        ];

        $I->assertSame($expected, $data);
    }

    public function testUntransformInObject(UnitTester $I)
    {
        $transformer = new ProfileTransformer();
        $payload =  [
            'favoriteColor' => 'blue',
        ];
        $resource = new ObjectItem($payload);

        $profile = $transformer->untransform($resource);

        $expected = (new Profile())
            ->setFavoriteColor(ColorType::byValue(ColorType::BLUE));

        $I->assertEquals($expected, $profile);
    }

    public function testUntransformInvalidValue(UnitTester $I)
    {
        $I->expectException(
            new TransformException('"orange" is not a valid value in the enum Test\Unit\Support\Entities\ColorType'),
            function() {
                $transformer = new ProfileTransformer();
                $payload =  [
                    'favoriteColor' => 'orange',
                ];
                $resource = new ObjectItem($payload);

                $transformer->untransform($resource);
        });
    }
}
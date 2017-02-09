<?php
declare(strict_types = 1);

namespace Test\Unit\FieldMap;

use UnitTester;
use Diaclone\Resource\FieldMap;

class FieldMapCest
{
    public function testEmptyConstructor(UnitTester $I)
    {
        $fields = new FieldMap();
        $I->assertEquals($fields->getFields(), '*');
        $I->assertTrue($fields->isWildcard());

        $fields = new FieldMap(null);
        $I->assertEquals($fields->getFields(), '*');
        $I->assertTrue($fields->isWildcard());

        $fields = new FieldMap('*');
        $I->assertEquals($fields->getFields(), '*');
        $I->assertTrue($fields->isWildcard());
    }

    public function testWildcardFields(UnitTester $I)
    {
        $fields = new FieldMap();
        $emptyField = new FieldMap();

        $I->assertEquals($fields->getField('id'), $emptyField);
        $I->assertEquals($fields->getField('name'), $emptyField);
    }

    public function testEmptyFields(UnitTester $I)
    {
        $fields = new FieldMap([]);

        $I->assertFalse($fields->isWildcard());
        $I->assertNull($fields->getField('id'));
        $I->assertNull($fields->getField('name'));
    }

    public function testSimpleFields(UnitTester $I)
    {
        $expected = [
            'id'   => new FieldMap(),
            'name' => new FieldMap(),
            'age'  => new FieldMap(),
        ];

        $fields = new FieldMap(array_keys($expected));
        $I->assertFalse($fields->isWildcard());
        $I->assertEquals($expected, $fields->getFields());
        $I->assertFalse($fields->hasField('color'));
        $I->assertNull($fields->getField('color'));
        $I->assertEquals(array_keys($expected), $fields->getFieldsList());

        // test: adding
        $expected['color'] = new FieldMap();
        $fields->addField('color');
        $I->assertTrue($fields->hasField('color'));
        $I->assertEquals($expected, $fields->getFields());

        // test: overwriting
        $expected['color'] = new FieldMap(['type', 'code']);
        $fields->addField('color', $expected['color']);
        $I->assertTrue($fields->hasField('color'));
        $I->assertEquals($expected, $fields->getFields());

        // test: removing
        unset($expected['color']);
        $fields->removeField('color');
        $I->assertFalse($fields->hasField('color'));
        $I->assertEquals($expected, $fields->getFields());
    }

    public function testComplexFields(UnitTester $I)
    {
        $actual = [
            'id'    => '*',
            'name'  => '*',
            'color' => ['type', 'code'],
        ];

        $expected = [
            'id'    => new FieldMap(),
            'name'  => new FieldMap(),
            'color' => new FieldMap([
                'type' => new FieldMap(),
                'code' => new FieldMap(),
            ]),
        ];

        $fieldMap = new FieldMap($actual);
        $I->assertEquals($expected, $fieldMap->getFields());
    }
}
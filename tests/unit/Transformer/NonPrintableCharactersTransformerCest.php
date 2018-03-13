<?php
declare(strict_types = 1);

use Diaclone\Resource\Item;
use Diaclone\Transformer\NonPrintableCharactersTransformer;

class NonPrintableCharactersTransformerCest
{
    public function testTransform(UnitTester $I)
    {
        $transformer = new NonPrintableCharactersTransformer();
        $data = 'String with non-printable characters' . $this->getNonPrintableCharacters();
        $resource = new Item($data);

        $transformed = $transformer->transform($resource);

        $I->assertEquals('String with non-printable characters', $transformed);
    }

    private function getNonPrintableCharacters(): string
    {
        $characters = [chr(127)];

        for ($code = 0; $code <= 31; $code++) {
            $characters[] = chr($code);
        }

        return implode('', $characters);
     }
}

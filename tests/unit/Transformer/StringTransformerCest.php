<?php
declare(strict_types = 1);

use Codeception\Example;
use Diaclone\Resource\Item;
use Diaclone\Transformer\StringTransformer;

class StringTransformerCest
{
    /**
     * @dataProvider getExampleForTransformation
     */
    public function testTransformation(UnitTester $I, Example $example)
    {
        $transformer = new StringTransformer();
        $resource = new Item($example['source']);
        $transformed = $transformer->transform($resource);

        $I->assertEquals($example['expectedTransformedResult'], $transformed);

        $resource = new Item($transformed);
        $untransformed = $transformer->untransform($resource);

        $I->assertEquals($example['expectedUntransformedResult'], $untransformed);
    }

    private function getExampleForTransformation(): array
    {
        return [
            [
                'source'                      => 'String with emoji :emoji-1f602:',
                'expectedTransformedResult'   => sprintf('String with emoji %s', "\xF0\x9F\x98\x82"),
                'expectedUntransformedResult' => 'String with emoji :emoji-1f602:',
            ],
            [
                'source'                      => sprintf('String with non-printable characters %s', $this->getNonPrintableCharacters()),
                'expectedTransformedResult'   => 'String with non-printable characters ',
                'expectedUntransformedResult' => 'String with non-printable characters ',
            ],
        ];
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

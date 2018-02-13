<?php
declare(strict_types = 1);

namespace Diaclone\Traits;

use Chefkoch\Morphoji\Converter;

trait EmojiTrait
{
    protected $converter = null;

    protected function convertFromEmojis(string $value)
    {
        return $this->getEmojiConverter()->fromEmojis($value);
    }

    protected function convertToEmojis(string $value)
    {
        return $this->getEmojiConverter()->toEmojis($value);
    }

    protected function getEmojiConverter(): Converter
    {
        if (! $this->converter) {
            $this->converter = new Converter();
        }

        return $this->converter;
    }
}

<?php
declare(strict_types = 1);

namespace Diaclone\Traits;

trait NonPrintableCharacterTrimmerTrait
{
    protected function trimNonPrintableCharacters(string $value)
    {
        return preg_replace('/[\x00-\x1F\x7F\xA0]/u', '', $value);
    }
}

<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

class InputOnlyDateTimeIso8601Transformer extends DateTimeIso8601Transformer
{
    public function allowTransform()
    {
        return false;
    }
}
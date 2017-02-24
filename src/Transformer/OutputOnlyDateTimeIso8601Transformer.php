<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

class OutputOnlyDateTimeIso8601Transformer extends DateTimeIso8601Transformer
{
    public function allowUntransform()
    {
        return false;
    }
}
<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;

class OutputOnlyDateTimeIso8601Transformer extends DateTimeIso8601Transformer
{
    public function allowUntransform(ResourceInterface $resource): bool
    {
        return false;
    }
}
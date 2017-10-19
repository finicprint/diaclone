<?php
declare(strict_types = 1);

namespace Diaclone\Transformer;

use Diaclone\Resource\ResourceInterface;

class InputOnlyDateTimeIso8601Transformer extends DateTimeIso8601Transformer
{
    public function allowTransform(ResourceInterface $resource): bool
    {
        return false;
    }
}
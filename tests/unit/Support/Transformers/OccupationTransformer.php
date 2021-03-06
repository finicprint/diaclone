<?php
declare(strict_types = 1);

namespace Test\Unit\Support\Transformers;

use Diaclone\Transformer\AbstractTransformer;
use Diaclone\Transformer\DateTimeIso8601Transformer;

class OccupationTransformer extends AbstractTransformer
{
    protected static $mappedProperties = [
        'name'       => 'name',
        'start_date' => 'startDate',
    ];

    protected static $transformers = [
        'start_date' => DateTimeIso8601Transformer::class,
    ];
}
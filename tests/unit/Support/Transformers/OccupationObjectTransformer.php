<?php
declare(strict_types = 1);

namespace Test\Unit\Support\Transformers;

use Diaclone\Transformer\AbstractObjectTransformer;
use Diaclone\Transformer\DateTimeIso8601Transformer;
use Test\Unit\Support\Entities\Occupation;

class OccupationObjectTransformer extends AbstractObjectTransformer
{
    protected static $mappedProperties = [
        'name'       => 'name',
        'start_date' => 'startDate',
    ];

    protected static $transformers = [
        'start_date' => DateTimeIso8601Transformer::class,
    ];

    public function getObjectClass(): string
    {
        return Occupation::class;
    }
}
<?php
declare(strict_types = 1);

namespace Test\Unit\Support\Transformers;

use Diaclone\Transformer\AbstractObjectTransformer;
use Diaclone\Transformer\StringTransformer;
use Test\Unit\Support\Entities\Occupation;

class OccupationTransformer extends AbstractObjectTransformer
{
    protected static $mappedProperties = [
        'name'       => 'name',
        'start_date' => 'startDate',
    ];

    protected static $transformers = [
        'name' => StringTransformer::class,
    ];

    public function getObjectClass(): string
    {
        return Occupation::class;
    }
}

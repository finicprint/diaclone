<?php
declare(strict_types=1);

namespace Test\Unit\Support\Transformers;

use Diaclone\Transformer\AbstractObjectTransformer;
use Test\Unit\Support\Entities\Profile;

class ProfileTransformer extends AbstractObjectTransformer
{
    protected static $mappedProperties = [
        'favoriteColor' => 'favoriteColor',
    ];

    protected static $transformers = [
        'favoriteColor' => ColorTypeTransformer::class,
    ];

    public function getObjectClass(): string
    {
        return Profile::class;
    }
}
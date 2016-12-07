<?php
declare(strict_types = 1);

namespace Test\Unit\Support\Transformers;

use Diaclone\Transformer\AbstractTransformer;
use Diaclone\Transformer\StringTransformer;

class CredentialTransformer extends AbstractTransformer
{
    protected static $mappedProperties = [
        'UserName' => 'username',
        'Password' => 'password',
    ];

    protected static $transformers = [
        'UserName' => StringTransformer::class,
        'Password' => StringTransformer::class,
    ];
}
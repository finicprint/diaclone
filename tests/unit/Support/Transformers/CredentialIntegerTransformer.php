<?php
declare(strict_types = 1);

namespace Test\Unit\Support\Transformers;

use Diaclone\Transformer\AbstractTransformer;
use Diaclone\Transformer\IntegerTransformer;
use Diaclone\Transformer\StringTransformer;

class CredentialIntegerTransformer extends AbstractTransformer
{
    protected static $mappedProperties = [
        'UserName' => 'username',
        'Password' => 'password',
    ];

    protected static $transformers = [
        'UserName' => StringTransformer::class,
        'Password' => IntegerTransformer::class,
    ];
}
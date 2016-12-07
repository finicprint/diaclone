<?php
declare(strict_types = 1);

namespace Test\Unit\Support\Transformers;

use Diaclone\Transformer\AbstractTransformer;
use Diaclone\Transformer\OutputOnlyStringTransformer;
use Diaclone\Transformer\StringTransformer;

class CredentialInputTransformer extends AbstractTransformer
{
    protected static $transformers = [
        'UserName' => StringTransformer::class,
        'Password' => OutputOnlyStringTransformer::class,
    ];

    protected static $mappedProperties = [
        'UserName' => 'username',
        'Password' => 'password',
    ];
}
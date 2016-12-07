<?php
declare(strict_types = 1);

namespace Test\Unit\Support\Transformers;

use Diaclone\Transformer\AbstractTransformer;
use Diaclone\Transformer\InputOnlyStringTransformer;
use Diaclone\Transformer\StringTransformer;

class CredentialOutputTransformer extends AbstractTransformer
{
    protected static $transformers = [
        'UserName' => StringTransformer::class,
        'Password' => InputOnlyStringTransformer::class,
    ];

    protected static $mappedProperties = [
        'UserName' => 'username',
        'Password' => 'password',
    ];
}
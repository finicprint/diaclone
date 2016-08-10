<?php
declare(strict_types=1);

namespace Diaclone\Facade;

use Illuminate\Support\Facades\Facade;

class TransformFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'transform';
    }
}

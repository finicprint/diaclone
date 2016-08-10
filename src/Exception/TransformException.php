<?php
declare(strict_types = 1);

namespace Diaclone\Exception;

use Exception;

class TransformException extends Exception
{
    public function __construct($message, $code = null, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
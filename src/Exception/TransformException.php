<?php
declare(strict_types = 1);

namespace Diaclone\Exception;

use Exception;

class TransformException extends Exception
{
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
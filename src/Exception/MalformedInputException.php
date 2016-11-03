<?php
declare(strict_types = 1);

namespace Diaclone\Exception;

class MalformedInputException extends TransformException
{
    protected $malformedFields = [];
    protected $transformer;

    public function __construct($fields, string $message = null)
    {
        $this->setMalformedFields($fields);

        $message = $message ?? self::messageFromFields($fields);

        parent::__construct($message);
    }

    public function getMalformedFields(): array
    {
        return $this->malformedFields;
    }

    public function setMalformedFields($malformedFields): MalformedInputException
    {
        $this->malformedFields = (array)$malformedFields;

        return $this;
    }

    public function getTransformer()
    {
        return $this->transformer;
    }

    public function setTransformer($transformer) : MalformedInputException
    {
        $this->transformer = $transformer;

        return $this;
    }

    protected static function messageFromFields($fields, $transformer = null)
    {
        $fields = is_string($fields) ? $fields : implode(', ', $fields);
        $class = $transformer ? get_class($transformer) : '';

        return "Problems un-transforming $fields" . ($class ? "in $class." : '.');
    }
}
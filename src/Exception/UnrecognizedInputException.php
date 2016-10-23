<?php
declare(strict_types = 1);

namespace Diaclone\Exception;

class UnrecognizedInputException extends TransformException
{
    protected $unrecognizedFields = [];
    protected $transformer;

    public function __construct($fields = [], $transformer = null, string $message = null)
    {
        $this->setUnrecognizedFields($fields);
        $this->setTransformer($transformer);

        $message = $message ?? self::messageFromFields($fields);

        parent::__construct($message);
    }

    public function getUnrecognizedFields(): array
    {
        return $this->unrecognizedFields;
    }

    public function setUnrecognizedFields($unrecognizedFields): UnrecognizedInputException
    {
        $this->unrecognizedFields = (array)$unrecognizedFields;

        return $this;
    }

    public function getTransformer()
    {
        return $this->transformer;
    }

    public function setTransformer($transformer) : UnrecognizedInputException
    {
        $this->transformer = $transformer;

        return $this;
    }

    protected static function messageFromFields($fields, $transformer = null)
    {
        if (is_string($fields)) {
            return "'$fields' is not defined in " . ($transformer ? get_class($transformer) : '');
        }

        return 'Unrecognized input fields: ' . implode(', ', $fields);
    }
}
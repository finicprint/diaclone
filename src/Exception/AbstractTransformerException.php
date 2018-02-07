<?php
declare(strict_types=1);

namespace Diaclone\Exception;

use Diaclone\Transformer\AbstractTransformer;

abstract class AbstractTransformerException extends TransformException
{
    private $invalidFields;
    /** @var AbstractTransformer */
    protected $transformer;

    public function __construct($fields, AbstractTransformer $transformer = null, string $message = null)
    {
        $this
            ->setInvalidFields($fields)
            ->setTransformer($transformer);

        $message = $message ?? $this->generateMessage();

        parent::__construct($message);
    }

    public function getTransformer()
    {
        return $this->transformer;
    }

    public function setTransformer($transformer): self
    {
        $this->transformer = $transformer;

        return $this;
    }

    abstract protected function generateMessage(): string;

    protected function getInvalidFields(): array
    {
        return $this->invalidFields;
    }

    protected function setInvalidFields($fields): self
    {
        $this->invalidFields = $fields;

        return $this;
    }

    protected function getFieldsForMessage(): string
    {
        return is_string($this->invalidFields) ? $this->invalidFields : implode(', ', $this->invalidFields);

    }

    protected function getTransformerForMessage(): string
    {
        return $this->transformer ? ' in ' . get_class($this->transformer) : '';
    }
}
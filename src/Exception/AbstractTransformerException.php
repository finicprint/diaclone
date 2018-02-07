<?php
declare(strict_types=1);

namespace Diaclone\Exception;

use Diaclone\Transformer\AbstractTransformer;

abstract class AbstractTransformerException extends TransformException
{
    private $invalidFields = [];
    /** @var AbstractTransformer */
    protected $transformer;

    public function __construct(array $fields, AbstractTransformer $transformer = null, string $message = null)
    {
        $this->setInvalidFields($fields);
        $this->transformer = $transformer;

        $message = $message ?? $this->generateMessage();

        parent::__construct($message);
    }

    public function getTransformer()
    {
        return $this->transformer;
    }

    abstract protected function generateMessage(): string;

    protected function getInvalidFields(): array
    {
        return $this->invalidFields;
    }

    protected function setInvalidFields(array $fields): self
    {
        $this->invalidFields = $fields;

        return $this;
    }

    protected function getFieldsForMessage(): string
    {
        return implode(', ', $this->invalidFields);

    }

    protected function getTransformerForMessage(): string
    {
        return $this->transformer ? ' in ' . get_class($this->transformer) : '';
    }
}
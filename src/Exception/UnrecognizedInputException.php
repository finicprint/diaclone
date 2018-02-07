<?php
declare(strict_types = 1);

namespace Diaclone\Exception;

class UnrecognizedInputException extends AbstractTransformerException
{
    public function getUnrecognizedFields(): array
    {
        return $this->getInvalidFields();
    }

    public function setUnrecognizedFields($unrecognizedFields): UnrecognizedInputException
    {
        $this->setInvalidFields($unrecognizedFields);

        return $this;
    }

    protected function generateMessage(): string
    {
        if (is_string($this->getInvalidFields())) {
            return "'{$this->getFieldsForMessage()}' is not defined{$this->getTransformerForMessage()}";
        }

        return "Unrecognized input fields: {$this->getFieldsForMessage()}{$this->getTransformerForMessage()}";
    }
}
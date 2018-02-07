<?php
declare(strict_types = 1);

namespace Diaclone\Exception;

class UnrecognizedInputException extends AbstractTransformerException
{
    public function getUnrecognizedFields(): array
    {
        return $this->getInvalidFields();
    }

    protected function generateMessage(): string
    {
        return "Unrecognized input fields: {$this->getFieldsForMessage()}{$this->getTransformerForMessage()}";
    }
}
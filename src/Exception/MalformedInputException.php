<?php
declare(strict_types = 1);

namespace Diaclone\Exception;

class MalformedInputException extends AbstractTransformerException
{
    public function getMalformedFields(): array
    {
        return $this->getInvalidFields();
    }

    protected function generateMessage(): string
    {
        return "Problems un-transforming {$this->getFieldsForMessage()}{$this->getTransformerForMessage()}";
    }
}
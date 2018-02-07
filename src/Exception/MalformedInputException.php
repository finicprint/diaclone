<?php
declare(strict_types = 1);

namespace Diaclone\Exception;

class MalformedInputException extends AbstractTransformerException
{
    protected $malformedFields = [];

    public function getMalformedFields(): array
    {
        return $this->getInvalidFields();
    }

    public function setMalformedFields($malformedFields): MalformedInputException
    {
        $this->setInvalidFields((array)$malformedFields);

        return $this;
    }

    protected function generateMessage(): string
    {
        return "Problems un-transforming {$this->getFieldsForMessage()}{$this->getTransformerForMessage()}";
    }
}
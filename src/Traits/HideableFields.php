<?php
declare(strict_types = 1);

namespace Diaclone\Traits;

trait HideableFields
{
    protected $hiddenFields = [];

    protected function setHiddenFields(array $fields) : self
    {
        $this->hiddenFields = $fields;

        return $this;
    }

    public function getMappedProperties(): array
    {
        return array_diff_key(parent::getMappedProperties(), array_flip($this->hiddenFields));
    }
}
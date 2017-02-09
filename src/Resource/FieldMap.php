<?php
declare(strict_types = 1);

namespace Diaclone\Resource;

class FieldMap
{
    /** @var string|array */
    private $fields;

    /**
     * FieldMap constructor.
     *
     * @param $fields
     */
    public function __construct($fields = '*')
    {
        $this->parse($fields);
    }

    private function parse($fields)
    {
        if ($fields === '*' || $fields === null) {
            $this->fields = '*';
        } elseif (is_array($fields)) {
            // reset fields
            $this->fields = [];

            if ($this->array_is_assoc($fields)) {
                // array of field => value
                foreach ($fields as $key => $value) {
                    $this->fields[$key] = $this->toFieldMap($value);
                }
            } else {
                // array of fields
                foreach ($fields as $value) {
                    $this->fields[$value] = new FieldMap();
                }
            }

        } else {
            $this->fields = [$this->toFieldMap($fields)];
        }
    }

    /**
     * @return bool
     */
    public function isWildcard(): bool
    {
        return $this->fields === '*';
    }

    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param $field
     * @return string
     */
    public function getField($field)
    {
        if ($this->fields === '*') {
            return new FieldMap();
        }

        return $this->fields[$field] ?? null;
    }

    /**
     * @param $field
     * @param $value
     *
     * @return mixed
     */
    public function addField($field, $value = '*')
    {
        return $this->fields[$field] = $this->toFieldMap($value);
    }

    /**
     * @param $field
     *
     * @return array
     */
    public function removeField($field)
    {
        unset($this->fields[$field]);
    }

    /**
     * has field
     *
     * @param $field
     *
     * @return bool
     */
    public function hasField($field): bool
    {
        return $this->isWildcard() || in_array($field, $this->getFieldsList());
    }

    /**
     *  Check if field map is empty
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return (empty($this->getFields()) && ! $this->isWildcard());
    }

    /**
     * Get names of all fields (top-level)
     *
     * @return array|string
     */
    public function getFieldsList()
    {
        return $this->isWildcard() ? '*' : array_keys($this->getFields());
    }

    /**
     * src: http://stackoverflow.com/a/4254008
     *
     * @param array $array
     *
     * @return bool
     */
    private function array_is_assoc(array $array): bool
    {
        return count(array_filter(array_keys($array), 'is_string')) > 0;
    }

    /**
     * Wrap value inside a field map
     *
     * @param $value
     *
     * @return FieldMap
     */
    private function toFieldMap($value): FieldMap
    {
        return $value instanceof FieldMap ? $value : new FieldMap($value);
    }
}
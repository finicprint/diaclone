<?php
declare(strict_types = 1);

namespace Diaclone\Resource;

abstract class AbstractResource implements ResourceInterface
{
    protected $data;
    protected $fieldMap;
    protected $resourceKey;

    public function __construct($data, $resourceKey, $fieldMap = '*')
    {
        $this->data = $data;
        $this->fieldMap = $fieldMap;
        $this->resourceKey = $resourceKey;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getFieldMap()
    {
        return $this->fieldMap;
    }

    public function getPropertyName()
    {
        return $this->resourceKey;
    }
}
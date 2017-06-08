<?php
declare(strict_types = 1);

namespace Diaclone\Connector;

class ObjectConnector extends Connector
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * each resource implements their own serialize according the cursor or driver
     * or reuse the parent one
     */
    protected function serialize($data)
    {
        $data = parent::serialize($data);
        return $data;
    }

    /**
     * each resource implements their own deserialize according the cursor or driver
     * or reuse the parent one
     */
    protected function deserialize($data)
    {
        $data = parent::deserialize($data);
        return $data;
    }

    protected function dataForTransformer($resource)
    {
        $this->resource = $resource;

    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }
}
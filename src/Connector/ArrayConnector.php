<?php
declare(strict_types = 1);

namespace Diaclone\Connector;

use Diaclone\Resource\AbstractResource;

class ArrayConnector extends Connector
{
    private $data;
    private $resource;

    public function __construct(array $data = [], AbstractResource $resource = null)
    {
        $this->data = $data;
        $this->resource = $resource;
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

    public function getData()
    {
        //querying to Elasticsearch by using $this->instance
    }

    public function setData($data)
    {
        //querying to Elasticsearch by using $this->instance
    }
}
<?php
declare(strict_types = 1);

namespace Diaclone\Conector;
use Elasticsearch\ClientBuilder;

class ElasticSearchConnector extends Connector
{
    private $data;
    private $instance;
    private $config;

    public function __construct($data)
    {
        $this->data = $data;
        if (empty($this->instance)) {
            $this->instance = ClientBuilder::create()->build();
        }
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
<?php
require '../../vendor/autoload.php';

declare(strict_types = 1);

namespace Diaclone\Connector;
use Elasticsearch\ClientBuilder;
use Diaclone\Serializer\SerializerAbstract;

class ElasticSearchConnector extends Connector
{
    private $data;
    private $instance;
    private $elastichsearch_params;

    public function __construct($data, array $params = [], array $hosts = [])
    {
        $this->data = $data;
        $this->elastichsearch_params = $params;
        if (empty($this->instance)) {
            if (!empty($hosts))
                $this->instance = ClientBuilder::create()->setHosts($hosts)->build();
            else
                $this->instance = ClientBuilder::create()->build();
        }
    }

    /**
     * @param SerializerAbstract $serializer
     * @return $this
     */
    public function setSerializer(SerializerAbstract $serializer)
    {
        $this->serializer = $serializer;
        return $this;
    }

    /**
     * @return SerializerAbstract
     */
    public function getSerializer(): SerializerAbstract
    {
        return $this->serializer;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
}
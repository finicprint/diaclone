<?php
declare(strict_types = 1);
namespace Diaclone\Connector;

require __DIR__ . '/../../vendor/autoload.php';

use Elasticsearch\ClientBuilder;
use Diaclone\Serializer\SerializerAbstract;

class ElasticSearchConnector extends Connector
{
    private $instance;

    protected $incomingData;
    protected $outgoingData;

    public function __construct($data = null, array $hosts = [])
    {
        $this->data = $data;
        if (empty($this->instance)) {
            if (!empty($hosts))
                $this->instance = ClientBuilder::create()->setHosts($hosts)->build();
            else
                $this->instance = ClientBuilder::create()->build();
        }
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getDataFromSource()
    {
        return $this->incomingData;
    }

    public function sendDataToSource($data)
    {
        return $this->outgoingData = $data;
    }

    public function getOutgoingData()
    {
        return $this->outgoingData;
    }

    /**
     * @return \Elasticsearch\Client
     */
    public function getInstance()
    {
        return $this->instance;
    }
}
<?php
declare(strict_types = 1);
namespace Diaclone\Connector;

use Elasticsearch\Client;

class ElasticSearchConnector extends Connector
{
    private $client;
    private $params;

    public function __construct( Client $client, array $params = [])
    {
        $this->params = $params;
        if (empty($this->client)) {
            $this->client = $client;
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
        unset($this->params['body']);
        return $this->client->get($this->params)['_source'];
    }

    public function sendDataToSource($data)
    {
        $this->params['body'] = $data;
        return $this->client->index($this->params);
    }

}
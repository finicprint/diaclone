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
    private $default_params = [
        'index' => '',
        'type' => ''
    ];

    public function __construct($data, array $params = [], array $hosts = [])
    {
        $this->data = $data;
        $this->default_params = $params;
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

    public function getInstance()
    {
        return $this->instance;
    }

    public function createDocuement(int $id, array $data)
    {
        $params = $this->default_params;
        $params['id'] = $id;
        $params['body'] = $data;
        //TODO: apply desearilize
        return $this->instance->index($params);
    }

    public function getDocument(int $id)
    {
        $params = $this->default_params;
        $params['id'] = $id;
        $response = $this->instance->get($params);
        //TODO; apply desearilize
        return $response;

    }

    public function updateDocument(int $id, array $data)
    {
        return $this->createDocuement($id, $data);
    }

    public function searchDocument(array $query)
    {
        $params = $this->default_params;
        $params['body'] = $query;
        $response = $this->instance->search($params);
        return $response;
    }

    public function deleteDocument(int $id)
    {
        $params = $this->default_params;
        $params['id'] = $id;
        $response = $this->instance->delete($params);
        return $response;
    }

    public function createIndex(string $index, array $body)
    {
        $params = [
            'index' => $index,
            'body' => $body
        ];

        $response = $this->instance->indices()->create($params);
        return $response;

    }

    public function deleteIndex(string $id)
    {
        $params = [
            'index' => $id
        ];

        $response = $this->instance->indices()->delete($params);
        return $response;
    }
}
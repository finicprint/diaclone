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

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return \Elasticsearch\Client
     */
    public function getInstance()
    {
        return $this->instance;
    }

    /**
     * ```
     * $params = [
     *   'index' => 'my_index',
     *   'type' => 'my_type',
     *   'id' => 'my_id',
     *   'body' => ['testField' => 'abc']
     *   ];
     *
     * ```
     * @param string $id
     * @param array $data
     * @return array
     */
    public function createDocument(string $id, array $data)
    {
        $params = $this->default_params;
        $params['id'] = $id;
        $params['body'] = $data;
        $response = $this->instance->index($params);
        return $response;
    }

    /**
     *
     * @param string $id
     * @return array
     */
    public function getDocument(string $id)
    {
        $params = $this->default_params;
        $params['id'] = $id;
        $response = $this->instance->get($params);
        //TODO; apply desearilize
        return $response;

    }

    /**
     * @param string $id
     * @param array $data
     * @return array
     */
    public function updateDocument(string $id, array $data)
    {
        return $this->createDocument($id, $data);
    }

    /**
     * @param array $query
     * @return array
     */
    public function searchDocument(array $query)
    {
        $params = $this->default_params;
        $params['body'] = $query;
        $response = $this->instance->search($params);
        return $response;
    }

    /**
     * @param string $id
     * @return array
     */
    public function deleteDocument(string $id)
    {
        $params = $this->default_params;
        $params['id'] = $id;
        $response = $this->instance->delete($params);
        return $response;
    }

    /**
     * @param string $index
     * @param array $body
     * @return array
     */
    public function createIndex(string $index, array $body)
    {
        $params = [
            'index' => $index,
            'body' => $body
        ];

        $response = $this->instance->indices()->create($params);
        return $response;

    }

    /**
     * @param string $id
     * @return array
     */
    public function deleteIndex(string $id)
    {
        $params = [
            'index' => $id
        ];

        $response = $this->instance->indices()->delete($params);
        return $response;
    }
}
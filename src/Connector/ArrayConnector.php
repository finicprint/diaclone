<?php
declare(strict_types = 1);

namespace Diaclone\Connector;

use Diaclone\Resource\AbstractResource;
use Diaclone\Serializer\ArraySerializer;
use Diaclone\Serializer\SerializerAbstract;

class ArrayConnector extends Connector
{
    private $data;
    private $serializer;

    public function __construct(SerializerAbstract $serializer = null)
    {
        $this->serializer = $serializer ?: new ArraySerializer();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function serialize($data)
    {
        $data = parent::serialize($data);
        return $data;
    }

    /**
     * @param $key
     * @param $dataTransformed
     * @param string $type
     */
    public function deserialize($key, $dataTransformed, $type = 'item')
    {
        if ($type == 'item') {
            $this->data = $this->serializer->item($key, $dataTransformed);
        } elseif($type == 'collection') {
            $this->data = $this->serializer->collection($key, $dataTransformed);
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
}
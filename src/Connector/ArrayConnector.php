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

    public function __construct(array $data = [])
    {
        $this->data = $data;
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
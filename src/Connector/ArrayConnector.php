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

    public function dataFromTransformer($key, $dataTransformed)
    {
        $this->data = $this->serializer->item($key, $dataTransformed);
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {

    }
}
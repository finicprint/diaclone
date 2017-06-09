<?php
declare(strict_types = 1);

namespace Diaclone\Connector;
use Diaclone\Serializer\SerializerAbstract;

class ObjectConnector extends Connector
{
    private $data;
    private $serializer;

    public function __construct($data)
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

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }
}
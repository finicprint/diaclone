<?php
declare(strict_types = 1);

namespace Diaclone\Connector;

class ObjectConnector extends Connector
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function serialize($data)
    {
        return $data;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function deserialize($data)
    {
        return $data;
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
<?php
declare(strict_types = 1);

namespace Test\Unit\Support\Connector;

use Diaclone\Connector\Connector;

class TestConnector extends Connector
{
    protected $incomingData;
    protected $outgoingData;

    public function __construct($data = null)
    {
        $this->incomingData = $data;
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
}

<?php
declare(strict_types = 1);

namespace Diaclone\Connector;

abstract class Connector
{
    protected $data;

    /**
     * @param array $data
     * @param String $connector_type
     * @return mixed
     */
    public static function getConnectorClassByType(String $connector_type = '')
    {
        if (empty($connector_type)){
            $default_connector = ConnectorRegistered::$connectorsCatalog['default'];
            return ConnectorRegistered::$connectorsCatalog[$default_connector];
        }
        return ConnectorRegistered::$connectorsCatalog[$connector_type];
    }

    abstract public function getDataFromSource();

    abstract public function sendDataToSource($data);

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }
}

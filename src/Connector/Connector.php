<?php
declare(strict_types = 1);

namespace Diaclone\Connector;


abstract class Connector
{

    /**
     * @param array $data
     * @param String $connector_type
     * @return mixed
     */
    public static function getConnectorByType(array $data, String $connector_type)
    {
        if (empty($connector_type)){
            $default_connector = ConnectorRegistered::$connectorsCatalog['default'];
            return new ConnectorRegistered::$connectorsCatalog[$default_connector]($data);
        }
        return new ConnectorRegistered::$connectorsCatalog[$connector_type]($data);
    }

    /**
     * @return mixed
     */
    abstract public function getData();

    /**
     * @param $data
     * @return mixed
     */
    abstract public function setData($data);

}
<?php
declare(strict_types = 1);

namespace Diaclone\Conector;


abstract class Connector
{

    public static function getConnector(array $data, String $connector_type)
    {
        if (empty($connector_type)){
            $default_connector = ConnectorRegistered::$conectorsCatalog['default'];
            return new ConnectorRegistered::$conectorsCatalog[$default_connector]($data);
        }
        return new ConnectorRegistered::$conectorsCatalog[$connector_type]($data);
    }

    /**
     * Serialize from array to object
     */
    protected function serialize($data): \stdClass
    {
        //WIP
        return $data;
    }

    /**
     * Serialize from object to array
     */
    protected function deserialize($data): Array
    {
        //WIP
        return $data;
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
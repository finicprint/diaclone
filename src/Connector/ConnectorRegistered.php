<?php
namespace Diaclone\Connector;

class ConnectorRegistered
{
    public static $connectorsCatalog = [
        'default' => 'mysql',
        'elasticsearch' => ElasticSearchConnector::class,
        'mysql' => MySQLConnector::class
    ];
}
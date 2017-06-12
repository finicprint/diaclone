<?php
namespace Diaclone\Connector;

class ConnectorRegistered
{
    public static $connectorsCatalog = [
        'default' => 'elasticsearch',
        'elasticsearch' => ElasticSearchConnector::class,
        'mysql' => MySQLConnector::class
    ];
}
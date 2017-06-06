<?php
namespace Diaclone\Conector;

class ConnectorRegistered
{
    public static $conectorsCatalog = [
        'default' => 'mysql',
        'elasticsearch' => ElasticSearchConnector::class,
        'mysql' => MySQLConnector::class
    ];
}
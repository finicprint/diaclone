<?php
namespace Diaclone\Conector;

class ConectorRegistered
{
    public static $conectorsCatalog = [
        'default' => ElasticSearConector::class,
        'elasticsear' => ElasticSearConector::class,
        'mysql' => MySQLConector::class
    ];
}
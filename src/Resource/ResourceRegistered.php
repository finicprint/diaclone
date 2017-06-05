<?php
namespace Diaclone\Resource;

class ResourceRegistered
{
    public static $resourcesCatalog = [
        'default' => ElasticSearResource::class,
        'elasticsear' => ElasticSearResource::class,
        'mysql' => MySQLResource::class
    ];
}
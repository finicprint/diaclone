<?php
declare(strict_types = 1);

namespace Diaclone\Resource;


abstract class Resource
{

    public static function getResource(array $data, String $resource_type)
    {
        //TODO: capture and throught exceptions
        if (empty($resource_type))
            return new ResourceRegistered::$resourcesCatalog['default']($data);

        return new ResourceRegistered::$resourcesCatalog[$resource_type]($data);
    }

    /**
     *
     */
    protected function serialize($data): \stdClass
    {
        return $data;
    }

    /**
     *
     */
    protected function deserialize($data): Array
    {
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
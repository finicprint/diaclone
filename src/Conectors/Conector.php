<?php
declare(strict_types = 1);

namespace Diaclone\Conector;


abstract class Conector
{

    public static function getResource(array $data, String $resource_type)
    {
        if (empty($resource_type))
            return new ConectorRegistered::$conectorsCatalog['default']($data);

        return new ConectorRegistered::$conectorsCatalog[$resource_type]($data);
    }

    /**
     * Serialize from array to
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
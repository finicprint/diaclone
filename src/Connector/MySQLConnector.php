<?php
declare(strict_types = 1);

namespace Diaclone\Connector;


class MySQLConnector extends Connector
{

    private $data;
    private $instance;

    public function __construct(array $data)
    {
        $this->data = $data;
        if (empty($this->instance)) {
            $this->instance = new \mysqli(
                getenv('MYSQL_HOST'),
                getenv('MYSQL_USER'),
                getenv('MYSQL_PASSWORD'),
                getenv('MYSQL_DBNAME')
            );
        }
    }

    /**
     * @param $data
     * @return mixed
     */
    public function serialize($data)
    {
        return $data;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function deserialize($data)
    {
        return $data;
    }

    public function getData()
    {
        //WIP
        //querying to mysql by using $this->instance
    }

    public function setData($data)
    {
        //WIP
        //querying to mysql by using $this->instance
    }
}
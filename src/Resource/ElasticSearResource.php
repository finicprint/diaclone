<?php
declare(strict_types = 1);

namespace Diaclone\Resource;


class ElasticSearResource extends Resource
{
    private $data;
    private $instance;
    private $config;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * each resource implements their own serialize according the cursor or driver
     * or reuse the parent one
     */
    protected function serialize($data)
    {
        $data = parent::serialize($data);
        return $data;
    }

    /**
     * each resource implements their own deserialize according the cursor or driver
     * or reuse the parent one
     */
    protected function deserialize($data)
    {
        $data = parent::deserialize($data);
        return $data;
    }

    public function getData()
    {

    }

    public function setData($data)
    {

    }
}
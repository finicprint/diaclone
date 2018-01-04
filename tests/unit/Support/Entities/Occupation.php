<?php
declare(strict_types = 1);

namespace Test\Unit\Support\Entities;

use DateTime;

class Occupation
{
    protected $name;
    protected $startDate;

    public static function create(string $name, string $startDate = null)
    {
        $occupation = new self();
        $occupation->name = $name;
        $occupation->startDate = $startDate ?: '2017-01-01 10:10:10';
        //$this->startDate = $startDate ?: (new DateTime())->format('Y-m-d H:i:s');

        return $occupation;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }
}

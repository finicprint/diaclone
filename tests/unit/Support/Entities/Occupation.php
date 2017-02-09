<?php
declare(strict_types = 1);

namespace Test\Unit\Support\Entities;

use DateTime;

class Occupation
{
    protected $name;
    protected $startDate;

    public function __construct(string $name, string $startDate = null)
    {
        $this->name = $name;
        $this->startDate = $startDate ?: '2017-01-01 10:10:10';
        //$this->startDate = $startDate ?: (new DateTime())->format('Y-m-d H:i:s');
    }

    public function getName()
    {
        return $this->name;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }
}
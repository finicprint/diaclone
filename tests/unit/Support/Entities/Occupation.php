<?php
declare(strict_types = 1);

namespace Test\Unit\Support\Entities;

use DateTime;
use DateTimeZone;

class Occupation
{
    protected $name;
    protected $startDate;

    public function __construct(string $name = null, string $startDate = null)
    {
        $this->name = $name;
        $startDate = $startDate ?: '2017-01-01 10:10:10';
        $this->startDate = new DateTime($startDate, new DateTimeZone("UTC"));
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function setStartDate(DateTime $startDate)
    {
        $this->startDate = $startDate;
    }
}
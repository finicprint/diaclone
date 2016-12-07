<?php
declare(strict_types = 1);

namespace Test\Unit\Support\Entities;

class Occupation
{
    protected $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}
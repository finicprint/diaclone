<?php
declare(strict_types = 1);

namespace Test\Unit\Support\Entities;

class Person
{
    public $my_job;

    protected $friends;
    protected $name;

    public function __construct($name, $occupation, array $friends = [])
    {
        $this->friends = $friends;
        $this->name = $name;
        $this->my_job = new Occupation($occupation);
    }

    public function getAge()
    {
        return 42;
    }

    public function getName()
    {
        return 'My name is ' . $this->name;
    }

    public function getNunya()
    {
        return 'secret';
    }

    public function getMyFriends()
    {
        return $this->friends;
    }
}
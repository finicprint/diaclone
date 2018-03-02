<?php
declare(strict_types = 1);

namespace Test\Unit\Support\Entities;

use JsonSerializable;

class Person implements JsonSerializable
{
    public $my_job;

    protected $age = 42;
    protected $friends;
    protected $name;

    public function __construct(string $name = null, string $occupation = null, array $friends = [])
    {
        $this->friends = $friends;
        $this->name = $name;
        if ($occupation) {
            $this->my_job = new Occupation($occupation);
        }
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAge(int $age)
    {
        $this->age = $age;
    }

    public function getName()
    {
        return 'My name is ' . $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getNunya()
    {
        return 'secret';
    }

    public function getMyFriends()
    {
        return $this->friends;
    }

    public function setMyFriends(array $friends)
    {
        $this->friends = $friends;
    }

    public function toArray()
    {
        return [
            'age'     => $this->age,
            'name'    => $this->name,
            'my_job'  => $this->my_job->getName(),
            'friends' => array_map(function($friend) {
                return is_array($friend) ? $friend : $friend->toArray();
            }, $this->friends),
        ];
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }


}
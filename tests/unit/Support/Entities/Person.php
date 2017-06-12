<?php
declare(strict_types = 1);

namespace Test\Unit\Support\Entities;

class Person
{
    /** @var Occupation */
    public $my_job;

    protected $age = 42;
    protected $friends;
    protected $name;

    public static function create($name, $occupation, array $friends = []): Person
    {
        $person = new self();
        $person->friends = $friends;
        $person->name = $name;
        $person->my_job = Occupation::create($occupation);

        return $person;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAge($age)
    {
        return $this->age = $age;
    }

    public function getName()
    {
        return 'My name is ' . $this->name;
    }

    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNunya()
    {
        return 'secret';
    }

    /**
     * @return Person[]
     */
    public function getMyFriends()
    {
        return $this->friends;
    }

    public function setMyFriends($friends): self
    {
        $this->friends = $friends;

        return $this;
    }
}

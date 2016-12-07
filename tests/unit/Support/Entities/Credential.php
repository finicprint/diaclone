<?php
declare(strict_types = 1);

namespace Test\Unit\Support\Entities;

class Credential
{
    protected $password;
    protected $username;

    public function __construct($username, $password)
    {
        $this->password = $password;
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getUserName()
    {
        return $this->username;
    }
}
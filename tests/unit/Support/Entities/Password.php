<?php
declare(strict_types=1);

namespace Test\Unit\Support\Entities;

final class Password
{
    /** @var string */
    private $password;

    public static function fromString(string $password): Password
    {
        return new self($password);
    }

    private function __construct(string $password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function toString(): string
    {
        return $this->password;
    }
}

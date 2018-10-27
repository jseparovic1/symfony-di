<?php
declare(strict_types=1);

namespace App\Entity;

class User
{
    const ROLE_USER = 'ROLE_USER';
    const ROLE_ADMIN = 'ROLE_ADMIN';

    /** @var string */
    private $username;

    /** @var string[] */
    private $roles = [];

    public function __construct(string $username)
    {
        $this->username = $username;
        $this->roles = [self::ROLE_USER];
    }

    public function addRole(string $role): self
    {
        $this->roles[] = $role;

        return $this;
    }

    public function hasRole(string $role): bool
    {
        return in_array($role, $this->roles, true);
    }
}

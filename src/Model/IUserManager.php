<?php

namespace App\Model;

interface IUserManager
{
    public function getUser(string $username): array;
    public function insertUser(array $credentials): int;
}

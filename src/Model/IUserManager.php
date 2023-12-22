<?php

namespace App\Model;

interface IUserManager
{
    public function insertUser(array $credentials): int;
}

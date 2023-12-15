<?php

namespace App\Model;

interface IUserManager
{
    public function getUser(string $username): array;
}

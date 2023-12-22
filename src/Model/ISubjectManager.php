<?php

namespace App\Model;

interface ISubjectManager
{
    public function insert(array $subject, int $user): string;

    public function update(array $subject, int $id): bool;
}

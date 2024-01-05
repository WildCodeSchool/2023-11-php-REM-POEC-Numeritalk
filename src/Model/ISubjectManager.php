<?php

namespace App\Model;

interface ISubjectManager
{
    public function insert(array $subject, int $user, $categoryId): string;

    public function update(array $subject, int $id): bool;
    public function getListSubject(int $categoryId);
}

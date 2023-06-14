<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Todo;

interface ITodoRepository
{
    public function findAll(): array;

    // public function findById(int $id): ?Todo;

    // public function save(Todo $todo): void;

    // public function update(Todo $todo): void;

    public function delete(int $id): bool;
}

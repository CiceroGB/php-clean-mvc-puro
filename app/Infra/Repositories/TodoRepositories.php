<?php
// app/Infrastructure/Repositories/TodoRepository.php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Todo;
use App\Application\Repositories\ITodoRepository;
use App\Infra\Database\SqlServerDatabase;

class TodoRepository implements ITodoRepository
{
    private $database;

    public function __construct()
    {
        $this->database = new SqlServerDatabase();
    }

    public function findAll(): array
    {
        $result = $this->database->query('SELECT * FROM todos');
        $todos = $result->fetchAll(\PDO::FETCH_CLASS, Todo::class);

        return $todos;
    }

    // public function findById(int $id): ?Todo
    // {
    //     $stmt = $this->database->query('SELECT * FROM todos WHERE id = :id');
    //     $stmt->execute([':id' => $id]);
    //     $todo = $stmt->fetchObject(Todo::class);

    //     return $todo ? $todo : null;
    // }

    // public function save(Todo $todo): void
    // {
    //     // Add the logic here to save the $todo entity into the database.
    //     // This will typically involve creating a SQL INSERT statement and calling $this->database->query().
    // }

    // public function update(Todo $todo): void
    // {
    //     // Add the logic here to update the $todo entity in the database.
    //     // This will typically involve creating a SQL UPDATE statement and calling $this->database->query().
    // }

    public function delete(int $id): bool
    {
        $stmt = $this->database->query('DELETE FROM todos WHERE id = :id');
        $result = $stmt->execute([':id' => $id]);

        return $result;
    }
}

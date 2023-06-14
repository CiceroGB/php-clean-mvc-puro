<?php
// app/Infrastructure/Repositories/TodoRepository.php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Todo;
use App\Domain\Repositories\ITodoRepository;
use App\Infra\Database\MySqlDatabase;

class TodoRepository implements ITodoRepository
{
    private MySqlDatabase $db;

    public function __construct(MySqlDatabase $db)
    {
        $this->db = $db;
    }

    public function findAll(): array
    {
        $stmt = $this->db->getConnection()->query('SELECT * FROM todos');
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Todo::class);
    }
}

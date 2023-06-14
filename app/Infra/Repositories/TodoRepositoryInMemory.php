<?php


namespace App\Infra\Repositories;

use App\Domain\Entities\Todo;
use App\Application\Repositories\ITodoRepository;


class TodoRepositoryInMemory implements ITodoRepository
{
    private $todos;

    public function __construct()
    {
        $firstTodo = new Todo(1, 'Primeiro', false);
        $secondTodo = new Todo(2, 'Segundo', false);
        $this->todos = [$firstTodo, $secondTodo];
    }

    public function findAll(): array
    {
        return $this->todos;
    }

    public function delete($id): bool
    {
        $key = array_search($id, $this->todos, true);
        if ($key === false) {
            return false;
        }
        unset($this->todos[$key]);
        return true;
    }
}

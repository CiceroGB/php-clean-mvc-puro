<?php

namespace App\Service\Usecases\Todo;

use App\Domain\Repositories\ITodoRepository;

class DeleteTodoListService
{
    private ITodoRepository $repository;

    public function __construct(ITodoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(int $id): bool
    {
        return $this->repository->delete($id);
    }
}

<?php

namespace App\Application\Usecases\Todo\Delete;

use App\Application\Repositories\ITodoRepository;
use App\Application\Usecases\Todo\Delete\IDeleteTodoUseCase;

class DeleteTodoUseCase implements IDeleteTodoUseCase
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

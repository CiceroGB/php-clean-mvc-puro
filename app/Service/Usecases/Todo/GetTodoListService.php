<?php

namespace App\Service\Usecases\Todo;

use App\Domain\Repositories\ITodoRepository;

class GetTodoListService
{
    private ITodoRepository $repository;

    public function __construct(ITodoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(): array
    {
        return $this->repository->findAll();
    }
}

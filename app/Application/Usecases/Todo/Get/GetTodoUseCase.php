<?php

namespace App\Application\Usecases\Todo\Get;

use App\Application\Repositories\ITodoRepository;
use App\Application\Usecases\Todo\Get\IGetTodoUseCase;

class GetTodoUseCase implements IGetTodoUseCase
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

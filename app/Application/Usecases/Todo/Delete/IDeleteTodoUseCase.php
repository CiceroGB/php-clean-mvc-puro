<?php

namespace App\Application\Usecases\Todo\Delete;


interface IDeleteTodoUseCase
{
    public function execute(int $id): bool;
}
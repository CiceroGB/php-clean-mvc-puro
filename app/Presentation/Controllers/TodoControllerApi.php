<?php


namespace App\Presentation\Controllers;


use App\Application\Usecases\Todo\Delete\IDeleteTodoUseCase;

class TodoControllerApi
{
    private $deleteTodoUseCase;

    public function __construct(
        IDeleteTodoUseCase $deleteTodoUseCase,

    ) {

        $this->deleteTodoUseCase = $deleteTodoUseCase;
    }

    public function delete(int $id)
    {
        return  $this->deleteTodoUseCase->execute($id);
    }
}

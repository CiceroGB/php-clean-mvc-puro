<?php


namespace App\Presentation\Controllers;


use App\Service\Usecases\Todo\DeleteTodoListService;

class TodoControllerApi
{
    private $deleteTodoListService;

    public function __construct(
        DeleteTodoListService $deleteTodoListService,

    ) {

        $this->deleteTodoListService = $deleteTodoListService;
    }

    public function delete(int $id)
    {
        return  $this->deleteTodoListService->execute($id);
    }
}

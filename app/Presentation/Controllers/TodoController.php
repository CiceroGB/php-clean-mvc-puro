<?php


namespace App\Presentation\Controllers;


use App\Service\Usecases\Todo\GetTodoListService;
use App\Presentation\Http\HttpResponder;

class TodoController
{
    private $getTodoListService;
    private $httpResponder;

    public function __construct(
        GetTodoListService $getTodoListService,
        HttpResponder $httpResponder
    ) {

        $this->getTodoListService = $getTodoListService;

        $this->httpResponder = $httpResponder;
    }

    public function index()
    {
        $todos = $this->getTodoListService->execute();
        $view = $this->httpResponder->renderView('list', ['todos' => $todos]);
        return $this->httpResponder->respond($view);
    }
}

<?php


namespace App\Presentation\Controllers;


use App\Application\Usecases\Todo\Get\IGetTodoUseCase;
use App\Presentation\Http\HttpResponder;

class TodoController
{
    private $getTodoUseCase;
    private $httpResponder;

    public function __construct(
        IGetTodoUseCase $getTodoUseCase,
        HttpResponder $httpResponder
    ) {

        $this->getTodoUseCase = $getTodoUseCase;

        $this->httpResponder = $httpResponder;
    }

    public function index()
    {
        $todos = $this->getTodoUseCase->execute();
        $view = $this->httpResponder->renderView('list', ['todos' => $todos]);
        return $this->httpResponder->respond($view);
    }

    public function teste()
        {
            $view = $this->httpResponder->renderView('teste');
            return $this->httpResponder->respond($view);
        }
    
}

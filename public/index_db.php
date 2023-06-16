<?php

require_once '../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


use App\Presentation\Controllers\TodoControllerApi;
use App\Presentation\Controllers\TodoController;
use App\Presentation\Controllers\UserController;
use App\Presentation\Http\HttpResponder;
use App\Infra\Repositories\TodoRepositoryInMemory;
use App\Application\Usecases\Todo\Get\GetTodoUseCase;
use App\Application\Usecases\Todo\Delete\DeleteTodoUseCase;
use App\Application\Usecases\User\LoginUseCase;
use App\Infra\Database\SqlServerDatabase;
use App\Infra\Repositories\TodoRepository;



$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

session_start();



try {
    // Inicializa controllers
    $controllers = initializeControllers();
    // Verifica a autenticação
    $controllers['user']->authenticate();
    // Lida com o roteamento
    handleRouting($requestMethod, $requestUri, $controllers);
} catch (Exception $e) {
    http_response_code(500);
    echo "Ocorreu um erro na aplicação:" . $e;
}



function initializeControllers(): array
{
    // $todoRepository = new TodoRepositoryInMemory();
    $db = new SqlServerDatabase();
    $todoRepository = new TodoRepository($db);

    $httpResponder = new HttpResponder();
    $getTodoUseCase = new GetTodoUseCase($todoRepository);
    $deleteTodoUseCase = new DeleteTodoUseCase($todoRepository);
    $loginUseCase = new LoginUseCase();

    $controllers = [
        'todo' => new TodoController($getTodoUseCase, $httpResponder),
        'todoApi' => new TodoControllerApi($deleteTodoUseCase),
        'user' => new UserController($loginUseCase),
    ];

    return $controllers;
}

function handleRouting($requestMethod, $requestUri, $controllers)
{
    $route = str_replace("/index.php", "", $requestUri);

    switch ($route) {
        case '/':
            if ($requestMethod === 'GET') {
                $controllers['todo']->index();
            }
            break;
        case '/teste':
            if ($requestMethod === 'GET') {
                $controllers['todo']->teste();
            }
            break;
        case preg_match('/\/api\/todo\/(\d+)\/delete/', $route, $matches) ? true : false:
            if ($requestMethod === 'POST') {
                $id = $matches[1];
                $controllers['todoApi']->delete($id);
            }
            break;
        default:
            // Caso nenhuma rota corresponda
            http_response_code(404);
            echo "Ops... Página não encontrada";
            break;
    }
}

<?php

require_once '../vendor/autoload.php';

use App\Presentation\Controllers\TodoControllerApi;
use App\Presentation\Controllers\TodoController;
use App\Presentation\Controllers\UserController;
use App\Presentation\Http\HttpResponder;
use App\Infra\Repositories\TodoRepositoryInMemory;
use App\Application\Usecases\Todo\Get\GetTodoUseCase;
use App\Application\Usecases\Todo\Delete\DeleteTodoUseCase;
use App\Application\Usecases\User\LoginUseCase;

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

session_start();

// Inicializa o repositório, serviços e controladores
list($controller, $controllerApi, $controllerUser) = initializeControllers();


try {
    // Verifica a autenticação
    $controllerUser->authenticate();
    // Lida com o roteamento
    handleRouting($requestMethod, $requestUri, $controller, $controllerApi);
} catch (Exception $e) {
    http_response_code(500);
    echo "Ocorreu um erro na aplicação:" . $e;
}



function initializeControllers(): array
{
    $todoRepository = new TodoRepositoryInMemory();
    $httpResponder = new HttpResponder();
    $getTodoUseCase = new GetTodoUseCase($todoRepository);
    $deleteTodoUseCase = new DeleteTodoUseCase($todoRepository);
    $loginUseCase = new LoginUseCase();

    $controller = new TodoController($getTodoUseCase, $httpResponder);
    $controllerApi = new TodoControllerApi($deleteTodoUseCase);

    $controllerUser = new UserController($loginUseCase);

    return [$controller, $controllerApi, $controllerUser];
}

function handleRouting($requestMethod, $requestUri, $controller, $controllerApi)
{
    $route = str_replace("/index.php", "", $requestUri);

    switch ($route) {
        case '/':
            if ($requestMethod === 'GET') {
                $controller->index();
            }
            break;
        case '/teste':
            if ($requestMethod === 'GET') {
                $controller->teste();
            }
            break;
        case preg_match('/\/api\/todo\/(\d+)\/delete/', $route, $matches) ? true : false:
            if ($requestMethod === 'POST') {
                $id = $matches[1];
                $controllerApi->delete($id);
            }
            break;
        default:
            // Caso nenhuma rota corresponda
            http_response_code(404);
            echo "Ops... Página não encontrada";
            break;
    }
}
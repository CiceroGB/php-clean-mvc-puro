<?php

namespace App\Presentation\Controllers;

use App\Application\Usecases\User\ILoginUseCase;

class UserController
{
    private $loginUseCase;

    public function __construct(ILoginUseCase $loginUseCase)
    {
        $this->loginUseCase = $loginUseCase;
    }

    public function authenticate()
    {
        if (!isset($_SESSION['permissao'])) {
            $result = $this->loginUseCase->login();
            if ($result) {
                $_SESSION['permissao'] = true;
                return;
            }
        }

        if (!$_SESSION['permissao']) {
            http_response_code(404);
            echo "Sem Permissão para a aplicação";
            die();
        }
    }
}

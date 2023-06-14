<?php

namespace App\Presentation\Controllers;

use App\Service\Usecases\User\LoginService;

class UserController
{
    private $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function authenticate()
    {
        if (!isset($_SESSION['permissao'])) {
            $result = $this->loginService->login();
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

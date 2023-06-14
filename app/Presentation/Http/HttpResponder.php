<?php

namespace App\Presentation\Http;

class HttpResponder
{
    public function renderView($viewName, $data = [])
    {
        extract($data);
        ob_start();
        include __DIR__ . "/../../../public/header.php";
        include __DIR__ . "/../views/{$viewName}.php";
        include __DIR__ . "/../../../public/footer.php";

        return ob_get_clean();
    }

    public function respond($content, $statusCode = 200)
    {
        http_response_code($statusCode);
        echo $content;
    }
}

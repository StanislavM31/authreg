<?php
require_once __DIR__ . '/classes/Registration.php';
require_once __DIR__ . '/classes/Midleware.php';

$midleware = new Middleware();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($midleware->isAjax()) {
        try {
            $midleware->getResponse();
        } catch (Exception $error) {
            http_response_code(500);
            echo "Ошибка: " . $error->getMessage();
        }
    } else {
        http_response_code(403);
        /* return ['status' => 'error', 'message' => "Error. это не ajax"]; */
        /* return $middleware->getResponse(); */
        exit($middleware->getResponse());
        
    }
}

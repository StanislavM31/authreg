<?php

require_once 'classes/Login.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            $login = $_POST['login'];
/*             $name = $_POST['name']; */
            $password = $_POST['password'];
            $loginObject = new Login();
            $response = $loginObject->authenticateUser($login, $password);
            //удаление по логину или по session_id
            sendJsonResponse($response);
        } else {
            throw new Exception("Ошибка. Это не Ajax-запрос");
        }
    } else {
        throw new Exception("Неверный метод запроса");
    }
} catch (Exception $error) {
    http_response_code(400);
    sendJsonResponse([
        'status' => 'error',
        'message' => $error->getMessage()
    ]);
}

function sendJsonResponse($data)
{
    header('Content-Type: application/json');
    echo json_encode($data);
}

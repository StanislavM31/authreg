<?php

require_once __DIR__ . '/classes/Registration.php';
require_once __DIR__ . '/classes/UserDbHandler.php.php';



session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        try {
            $login = $_COOKIE['login'];
            $email = $_COOKIE['email'];

            $delete = new userDbHandler();
            $deleteResult = $delete->deleteUser($login);

            if ($deleteResult) {
                $response = array('status' => 'success', 'message' => 'Данные пользователя успешно удалены.');
            } else {
                $response = array("status" => "error", "message" => 'Пользователь не удален');
            }

            header('Content-Type: application/json');
            echo json_encode($response);
        } catch (Exception $error) {
            http_response_code(500);
            echo "Ошибка: " . $error->getMessage();
        }
    } else {
        http_response_code(403);
        return ['status' => 'error', 'message' => "Error. это не ajax"];
    }
}

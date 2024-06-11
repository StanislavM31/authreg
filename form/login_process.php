<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $data = file_get_contents('db.json');
        $users = json_decode($data, true);

        $user = null;

        foreach ($users as $userData) {
            if ($userData['login'] === $login && $userData['password'] === $password) {
                $user = $userData;
                break;
            }
        }

        if ($user) {
            session_start();

            $_SESSION['login'] = $user['login'];
            setcookie('login', $user['login'], time() + 30);
            setcookie('password', $user['password'], time() + 30);
            setcookie('session_id', session_id(), time() + 30, '/');

            $response = array("status" => "success", "message" => "Авторизация успешна");
        } else {
            $response = array("status" => "error", "message" => "Неверный логин или пароль");
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        http_response_code(403);
        echo "Ошибка. Это не Ajax-запрос";
        exit();
    }
}
?>
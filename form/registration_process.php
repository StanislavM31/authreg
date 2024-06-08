<?php
require_once __DIR__ . '/classes/Registration.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];
        $email = $_POST['email'];

        $registration = new Registration($login, $password, $confirmPassword, $email);
        $registrationResult = $registration->register();

        if ($registrationResult === true) {
            session_start();
            $_SESSION['login'] = $login;
            setcookie('login', $login, time() + 50);
            $response = array("status" => "success", "message" => "Регистрация успешна");
            /*  */
        } else {
            $response = array("status" => "error", "message" => $registrationResult);
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        http_response_code(403);
        echo "ошибка. это не Ajax-запрос";
        exit();
    }
}

<?php
require_once __DIR__ . '/classes/Registration.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        try {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $email = $_POST['email'];
            $session_id = session_id();

            $registration = new Registration($login, $password, $confirmPassword, $email, $session_id);
            $registrationResult = $registration->register();

            if ($registrationResult === true) {
                /* session_start(); */
                $_SESSION['login'] = $login;
                setcookie('login', $login, time() + 50);
                $response = array("status" => "success", "message" => "Регистрация успешна");
                /*  */
            } else {
                session_destroy();
                $response = array("status" => "error", "message" => $registrationResult);
            }

            header('Content-Type: application/json');
            echo json_encode($response);
        } catch (Exception $error) {
            http_response_code(500);
            echo "Произошла ошибка: " . $error->getMessage();
        }
    } else {
        http_response_code(403);
        echo "ошибка. это не Ajax-запрос";
        exit();
    }
}
?>
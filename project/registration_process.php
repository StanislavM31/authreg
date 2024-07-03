<?php
require_once __DIR__ . '/classes/Registration.php';




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        try {
            session_start();
            $login = $_POST['login'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $email = $_POST['email'];
            $session_id = session_id();

            $registration = new Registration($login, $password, $confirmPassword, $email, $session_id);
            $registrationResult = $registration->register();

            if ($registrationResult === true) {
                $_SESSION['login'] = $login;
                setcookie('login', $login, time() + 300);
                setcookie('session_id', session_id(), time() + 300);
                $response = array("status" => "success", "message" => "Регистрация успешна");
                http_response_code(200);
            } else {
                session_destroy();
                $response = array("status" => "error", "message" => $registrationResult);
                http_response_code(400); //тогда fetch заходит в .catch блок
                header('Content-Type: application/json');

            }

            header('Content-Type: application/json');
            echo json_encode($response);
        } catch (Exception $error) {
            http_response_code(500);
            $response = array("status" => "error", "message" => $error->getMessage());
            echo json_encode($response);
        }
    } else {
        http_response_code(403);
        echo json_encode(array('status' => 'error', 'message' => "Error. это не ajax"));
    }
}

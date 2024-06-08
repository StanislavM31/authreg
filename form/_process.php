<?php
require_once __DIR__ . '/classes/Registration.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['login'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $email = $_POST['email'];

    $registration = new Registration($username, $password, $confirmPassword, $email);
    $registrationResult = $registration->register();

    if ($registrationResult === true) {
        session_start();
        $_SESSION['username'] = $username;
        setcookie('username', $username, time() + 30);
        $response = array("status" => "success", "message" => "Регистрация успешна");
        /*  */
    } else {
        $response = array("status" => "error", "message" => $registrationResult);
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    
}
?>
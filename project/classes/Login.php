<?php
require_once __DIR__ . '/UserDbHandler.php';
require_once 'classes/UserDbHandler.php';

class Login
{
    public function authenticateUser($login, $password)
    {
        $userDbHandler = new UserDbHandler();
        $authResult = $userDbHandler->authenticateUser($login, $password);
    
        switch ($authResult) {
            case 'no user':
                return ['status' => 'no user', 'message' => 'Пользователь не найден'];
            case 'error password':
                return ['status' => 'error password', 'message' => 'Неверный пароль'];
            case 'success':
                $this->startSession($login);
                return ['status' => 'success', 'message' => 'Авторизация успешна'];
            default:
                return ['status' => 'error', 'message' => 'Произошла ошибка при аутентификации'];
        }
    }

    private function startSession($login)
    {
        session_start();
        $_SESSION['login'] = $login;
        setcookie('login', $login, time() + 30, '/', '', true, true);
        setcookie('session_id', session_id(), time() + 30, '/', '', true, true);
    }
}
?>
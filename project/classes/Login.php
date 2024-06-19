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
        $userDbHandler = new UserDbHandler();
        $sessionID = $userDbHandler->giveMeSessionID($login);
        if ($sessionID) {

            session_id($sessionID); 
            session_start();

            $_SESSION['login'] = $login;
            setcookie('login', $login, time() + 30, '/');
            setcookie('session_id', $sessionID, time() + 30, '/');
        } else {
            $_SESSION['login'] = $login;
            setcookie('login', $login, time() + 30, '/');
            setcookie('session_id', "smthWrngWhthSessionID", time() + 30, '/');
        }
    }
}

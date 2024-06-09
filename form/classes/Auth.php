<?php

class Auth
{
    private $users;
    /*     public function __construct()
    {
        $data = file_get_contents('db.json');
        $this->users = json_decode($data, true);
    } */

    public function login($login, $password)
    {
        session_start();
        $sessionId = session_id();
        foreach ($this->users as $user) {
            if ($user['login'] === $login && $user['password'] === $password) {
                $_SESSION['login'] = $user['login'];
                setcookie('login', $user['login'], time() + 30, '/');
                echo "\n";
                setcookie('password', $user['password'], time() + 30, '/');
                echo "\n";
                setcookie('session_id', $sessionId, time() + 30, '/');
                echo "\n";
                echo 'Cookie username: ' . $_SESSION['login'];

                return true;
            }
        }

        return false;
    }

/*     public function logout()
    {
        unset($_SESSION['login']);
        setcookie('login', '', time() - 3600);
    } */

    public function isLoggedIn()
    {
        $cookieSessionId = $_COOKIE['session_id'] ?? null;
        $currentSessionId = session_id();
    
        echo "---Cookie session_id: ";
        print_r($cookieSessionId);
        echo "---Current session_id: ";
        print_r($currentSessionId);
    
        if ($cookieSessionId !== null && $cookieSessionId == $currentSessionId) {
            echo "id_куки == id_session \n";
            return true;
        } else {
            echo "(не равно) id_куки !== id_session \n";
            return false;
        }
    }

    public function isSessionActive()
    {
        return session_status() === PHP_SESSION_ACTIVE;
    }
}

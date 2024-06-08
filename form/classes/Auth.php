<?php

class Auth
{
    private $users;

    public function __construct()
    {
        $data = file_get_contents('db.json');
        $this->users = json_decode($data, true);
    }

    public function login($login, $password)
    {
        session_start();
        $sessionId = session_id();
        foreach ($this->users as $user) {
            if ($user['login'] === $login && $user['password'] === $password) {
                $_SESSION['login'] = $user['login'];
                setcookie('login', $user['login'], time() + 30, '/');
                setcookie('password', $user['password'], time() + 30, '/');
                setcookie('session_id', $sessionId, time() + 30, '/');
                echo '==== <br>';
                echo 'Cookie username: ' . $_SESSION['login'];
            
                return true;
            }
        }

        return false;
    }

    public function logout()
    {
        unset($_SESSION['login']);
        setcookie('login', '', time() - 3600);
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['login'])) {
            return true;
        } else {
            return false;
        }
    }
        public function isSessionActive()
    {
        return session_status() === PHP_SESSION_ACTIVE;
    }
}

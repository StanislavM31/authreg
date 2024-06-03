<?php

class Auth
{
    private $users;

    public function __construct()
    {
        $data = file_get_contents('db.json');
        $this->users = json_decode($data, true);
    }

    public function login($username, $password)
    {
        session_start();

        foreach ($this->users as $user) {
            if ($user['login'] === $username && $user['password'] === $password) {
                $_SESSION['username'] = $user['login'];
                setcookie('username', $user['login'], time() + 30);
                return true;
            }
        }

        return false;
    }

    public function logout()
    {
        unset($_SESSION['username']);
        setcookie('username', '', time() - 3600);
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['username'])) {
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

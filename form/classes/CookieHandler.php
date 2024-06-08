<?php

class CookieHandler
{
    public $login;
    public $password;
    public $sessionId;

    public function __construct()
    {
        $this->login = isset($_COOKIE['login']) ? $_COOKIE['login'] : null;
        $this->password = isset($_COOKIE['password']) ? $_COOKIE['password'] : null;
        $this->sessionId = isset($_COOKIE['PHPSESSID']) ? $_COOKIE['PHPSESSID'] : null;
    }

    public function displayCookies()
    {
        if ($this->login !== null && $this->password !== null && $this->sessionId !== null) {
            echo 'Cookie username: ' . $this->login . '<br>';
            echo 'Cookie password: ' . $this->password . '<br>';
            echo 'Cookie sessionId: ' . $this->sessionId . '<br>';
        } else {
            echo 'Куки username, password или session_id отсутствуют.';
        }
    }



    public function getUsername()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        return $this->login;
    }
}
